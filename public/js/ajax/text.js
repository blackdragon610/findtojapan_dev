/*
*	データを読み込みページ表示させるための処理
*/
function AjaxText(id,url,fnc){
var self = this;
this.id = id;
this.url = url;
this.fnc = fnc;

	//情報の読み込み
	this.load = function(page){		
		var ajaxText = new AjaxServer(self.url);

		ajaxText.fnc = self.complateTextHandle;
		ajaxText.dataType = 'json';
		ajaxText.data = {text:$(self.id).val()};

		ajaxText.access();
	}

	this.complateTextHandle = function(data){		
		self.fnc(data);
	}
	
	$(this.id).blur(this.load);
}