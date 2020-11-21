	$(function(){
		var isPopup = false


		$('body').click(function(){
			if (!isPopup){
				$('.popup').css('display', 'none')
			}else{
				isPopup = false
			}
		})

		var heightAll = $(window).height()
		heightAll-= $("#header").height() + $("#footer").height() + 40

		$('.contents-body-all').height(heightAll)
								
		$('.popup-from').click(function(){
			isPopup = true
			$('.' + $(this).attr('target')).css('display', 'block')
		})
		
		$('.destory').click(function(){
			Swal.fire({
			  title: '確認',
			  text: "削除しても宜しいですか？",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '実行する',
			  cancelButtonText: 'キャンセル'
			}).then((result) => {
			  if (result.value){
				  $(this).parent().submit()
			  }
			  
			})
			
			return false
		})
		
		$('.factoring').click(function(){
			Swal.fire({
			  title: '確認',
			  text: "請求書買取を申請して宜しいですか？",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '実行する',
			  cancelButtonText: 'キャンセル'
			}).then((result) => {
			  if (result.value){
				  location.href = $(this).attr('target')
			  }
			  
			})
			
			return false
		})
		
		$('.factoring-cancel').click(function(){
			Swal.fire({
			  title: '確認',
			  text: "請求書買取を取消して宜しいですか？",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '実行する',
			  cancelButtonText: 'キャンセル'
			}).then((result) => {
			  if (result.value){
				  location.href = $(this).attr('target')
			  }
			  
			})
			
			return false
		})		

		$('.factoring-ok').click(function(){
			Swal.fire({
			  title: '確認',
			  text: "請求書買取を了承して宜しいですか？",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '実行する',
			  cancelButtonText: 'キャンセル'
			}).then((result) => {
			  if (result.value){
				  $(this).removeClass('btn-default')
				  $(this).addClass('btn-primary')
				  $(this).html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>承認済')

			  }
			  
			})
			
			return false
		})			
		

		$('.csv').click(function(){
			var my = $(this)
						
			Swal.fire({
			  title: '確認',
			  text: "CSVでアップロードしても宜しいですか？",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: '実行する',
			  cancelButtonText: 'キャンセル'
			}).then((result) => {
			  if (result.value){
				  my.submit()
			  }
			  
			})
			
			return false
		})
		
		$('#checkbox-all').click(function(){
			
			if ($(this).prop('checked')){
				$('.checkbox-item').prop('checked', true)			
			}else{
				$('.checkbox-item').prop('checked', false)							
			}
		})
		
		$('.popup-from').find('.click-from').click(function(){
			$(this).parent().find('.popup-to').css('display', 'block')
		})		
		
		$('.popup-to').find('.click').click(function(){		
			$(this).parent().parent().find('.popup-to').css('display', 'none')			
		})
		
	})

	/**
	 * 数値をカンマ区切りに変換する
	 */
	function number_format(num, decimals)
	{
		//小数点以下の表示桁数
		var _decimals = decimals | 0;

		//指定桁以下を切り捨てた数値
		var _shift = Math.pow(10, _decimals);
		var _floor = Math.floor(num * _shift) / _shift;

		//整数部と小数部に分ける
		var _integerPart = Math.floor(_floor);
		var _decimalPart = (_floor.toString().split('.').length > 1) ? _floor.toString().split('.')[1] : '';

		//整数部にカンマを付与
		var _num = Math.abs(_integerPart).toString().split(/(?=(?:\d{3})+$)/).join();

		//小数部を付与
		if (_decimals > 0) {
			var zeroStr = '';
			for (var i = 0; i < _decimals; i ++) zeroStr += '0';
			_num += '.' + (zeroStr + _decimalPart).slice(-_decimals);
		}

		//負の記号を付与して返却
		return (num < 0) ? ('-' + _num) : _num;
	}

	//印刷
	function printPdf(url) {
		var iframe = document.createElement('iframe');
		// iframe.id = 'pdfIframe'
		iframe.className='pdfIframe'
		document.body.appendChild(iframe);
		iframe.style.display = 'none';
		iframe.onload = function () {
			setTimeout(function () {
				iframe.focus();
				iframe.contentWindow.print();
				URL.revokeObjectURL(url)
				// document.body.removeChild(iframe)
			}, 1);
		};
		iframe.src = url;
		// URL.revokeObjectURL(url)
	}