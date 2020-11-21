/*
*	ページ読み込みの処理
*/
function AjaxPage(id){
var self = this;
this.id=id;
this.fnc;

	this.setPage = function(url){
		var ajaxArea = new AjaxServer(url);
		ajaxArea.fnc = this.complatePageHandle;
		ajaxArea.access();
	}

	this.complatePageHandle = function(data){
		$(self.id).html(data);

		if (self.fnc){
			self.fnc(data);
		}
	}
}

