/*
*	住所関連の処理
*/

function AjaxArea(areaID,cityID,townID){
var self = this;
this.api = '/api/area/';
this.areaID = areaID;
this.cityID = cityID;
this.townID = townID;
this.zip1 = '';
this.zip2 = '';

	this.setData = function(pid, cid, tid){
		$(self.areaID).val(pid);
						
		self.pid = pid;
		self.cid = cid;
		self.tid = tid;

		$(self.areaID).val(self.pid);
		$(self.cityID).val(self.cid);		
		$(self.townID).val(self.tid);
		
		self.reflash();
	}

	//全ての変更処理
	this.reflash = function(){
		self.change(self.areaID, self.cityID);	

		self.complateHandlePlus=function(){
			$(self.cityID).val(self.cid);
			
			
			self.cid= '';
			
			self.change(self.cityID, self.townID);	
			
			self.complateHandlePlus=function(){
				$(self.townID).val(self.tid);
				self.tid= '';
				
				self.complateHandlePlus='';
			}	
		}
	}	
	
	//郵便番号での設定も可能にする
	this.setZip = function(zip1, zip2){

		if (zip1){
			self.zip1 = zip1;
			$(zip1).bind('keyup', '', self.changeZip);
		}
		if (zip2){
			self.zip2 = zip2;
			$(zip2).bind('keyup', '', self.changeZip);	
		}
	}
	
	this.changeZip = function(data){
		var zip = '';
		if (self.zip1){
			zip+= $(self.zip1).val();
		}
		if (self.zip2){
			zip+= $(self.zip2).val();
		}
				
		if (zip.length >=7){
			var ajaxArea = new AjaxServer(self.api + '?zip=' + zip);		
			ajaxArea.dataType = 'json';
			ajaxArea.fnc = self.complateZip;
			ajaxArea.access();
		}

	}	
	this.complateZip = function(data){
		$(self.areaID).val(data.pid);
		
		self.cid = data.jis;
		self.tid = data.id;
		
		self.reflash();
	}
	
	//都道府県設定
	this.setPre = function(){
		var ajaxArea = new AjaxServer('/api/pre/');
		ajaxArea.dataType = 'json';
		ajaxArea.fnc = function(data){	
    	
    	
			$(self.areaID).html('');
			var html = '<option value="">-</option>';
			for (var i = 1; i <= 47; i++){
				var key = i;

				if (i <10){
					key = '0' + i
				}				
				html+='<option value="' + key + '">' + data[key] + '</option>';
			}
			
			$(self.areaID).html(html);
			
			$(self.areaID).val(self.pid);
			
			if (self.complatePre){
				self.complatePre();
			}
		};
		ajaxArea.access();
	}
	
	//都道府県が変わった時
	this.changeHandle = function(event){		
		self.change(event.data.my, event.data.target);
	}
	
	this.change = function(my,target){	
		self.target = target;		
				
		var pid = $(my).val();
		
		if(my == self.areaID){
			var ajaxArea = new AjaxServer(self.api + '?pid=' + pid);
		}
		if(my == self.cityID){
			var ajaxArea = new AjaxServer(self.api + '?jis=' + pid);
		}
				
		ajaxArea.dataType = 'json';
		ajaxArea.fnc = self.complateHandle;
		ajaxArea.access();

	}
	
	this.complateHandle = function(data){
		
		var html = '';										
										
		html+='<option value="">' + $(self.target + ' option').eq(0).text()+ '</option>';		
		for (var key in data){
			html+='<option value="' + data[key].id + '">' + data[key].value + '</option>';
		}

		
		$(self.target).html(html);
		
		self.complateHandlePlus();
	}
	
	this.complateHandlePlus = function(){}
		
	$(self.areaID).bind('change', {my:self.areaID, target:self.cityID}, self.changeHandle);
	$(self.cityID).bind('change', {my:self.cityID, target:self.townID}, self.changeHandle);

	
}

