@extends('layouts/admin', ['pageType' => 1, 'isLayoutEdit' => true])

@section('main')
	<section class="content">
	  <div class="box">
	    <div class="box-body">
	
				<div id="customer" class="contents-main">
	
					<h2 class="title2 text-center">データが更新されました</h2>
	
					<p class="mt text-center">
						データが更新されました。<br />
						下記のボタンから一覧に戻ってください。							
					</p>
	
				</div>
	    </div>
	  </div>
	
		<div class="mt-lg text-center">
			<a href="{{route('admin.prime.index')}}" class="btn btn-primary btn-lg">一覧に戻る</a>
		</div>							
	
	</section>
@endsection
