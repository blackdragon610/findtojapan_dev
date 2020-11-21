	<div class="circle-blue">
		<ul class="list">
			<li @if($menu == 1) class="active"@endif><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'account')}}">ご利用履歴</a></li>
			<li class="mt @if($menu == 2)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'account.login')}}">ログイン情報</a></li>
			<li class="mt @if($menu == 3)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'account.seal')}}">判子の登録</a></li>
			<li class="mt @if($menu == 4)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'account.design')}}">デザイン設定</a></li>
			<li class="mt @if($menu == 5)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'account.view')}}">表示設定</a></li>
			<li class="mt @if($menu == 6)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . 'twofactor')}}">二段階認証</a></li>
			<li class="mt @if($menu == 7)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . "accountadd")}}">追加アカウント</a></li>

			@if ($isPrime)
				<li class="mt @if($menu == 8)active @endif"><span class="glyphicon mr glyphicon-ok" aria-hidden="true"></span><a href="{{route($pageRoot . "accountadd")}}">ファクタリング締め日設定</a></li>
			@endif

		</ul>
	</div>
