/*
*	データを読み込みページ表示させるための処理
*/
function AjaxSuggest(tID, id, url){
var self = this;
this.value = '';
this.id = id;
this.count = 0;
this.page = -1;
this.url = url;
this.tID = tID;
this.max = 0;
this.arrayPage = new Array();
this.objData = new Object();

	AjaxServer.apply(this,new Array(url));

	//情報の読み込み
	this.load = function(keyword){		
		if (keyword.length >= 2){
			self.fnc = self.complateDataHandle;
			self.dataType = 'json';
			self.data = {keyword:keyword};
	
			self.access();
		}
	}

	this.complateDataHandle = function(data){		
		var html = '';
		$(this.id).html('');
					
		if (data['arrayItem'].length){
			$(self.id).css('display', 'block');

			$(this.id).append('<option value="">選択して下さい</option>');
	
			var html = '';			
			for (var key in data['arrayItem']){
				var value = self.value;
				
				for (var keyItem in data['arrayItem'][key]){
					value = value.replace(new RegExp('{{{' + keyItem + '}}}',"g"), data['arrayItem'][key][keyItem]);
				}
				
				html+=value;
								
				
				self.count++;
			}
			$(this.id).append(html);

			$(self.id).unbind('change', '', self.onClickHandle);			
			$(self.id).bind('change', '', self.onClickHandle);
		}else{
			$(self.id).css('display', 'none');
		}
		complateSuggestHandle(data);
	}

	this.onClickHandle = function(event){
		var html = $(event.target).html();
		
		var out = $(self.id + ' option:selected').attr('out');
		
		$(self.tID).val(out);
		$(self.id).css('display', 'none');
		
		self.complateSuggEndHandle(id,out);
	}
	
	this.complateSuggEndHandle = function(id, out){
		
	}

	this.changeText = function(event){
		self.load($(self.tID).val());
	}


	$(this.tID).bind('keyup','', this.changeText);

}