/*
*	データを読み込みページ表示させるための処理
*/
function AjaxEdit(url,fnc){
var self = this;
this.url = url;
this.fnc = fnc;

	//情報の読み込み
	this.reflash = function(data){			
		var ajaxEdit = new AjaxServer(self.url);

		ajaxEdit.fnc = self.complateEditHandle;
		ajaxEdit.dataType = 'json';
		ajaxEdit.data = data

		ajaxEdit.access();
	}

	this.complateEditHandle = function(data){		
		self.fnc(data);
	}
	
	$(this.id).blur(this.load);
}