@extends('layouts/admin', ['pageType' => 1, 'isLayoutList' => true])

@section('header')
	@parent
@endsection

@section('main')


  <section class="content">
    <div class="box">
      <div class="box-body">
		<div class="mt">
			@include('layouts.parts.message')

            <h2 class="title2">一覧</h2>

            <div class="text-right">
                <a href="{{route("admin.company.create")}}" class="btn btn-primary">新規登録</a>
            </div>
            <div class="btn">
              <span class="attention">{{$lists->total()}}件</span>&nbsp;が該当しました。
            </div>

            <div class="mt-lg text-center">
                @include('layouts.parts.navi')
            </div>


            <div class="table mt">
                <div class="tr">
                    <div class="th">ID</div>

                    <div class="th">
                        日本語表記
                    </div>
                    <div class="th">
                        英語表記
                    </div>
                    <div class="th">
                        電話番号
                    </div>
                    <div class="th">

                    </div>

                </div>

                @foreach ($lists as $list)
                <div class="tr">
                    <div class="td">
                        {{$list->id}}
                    </div>
                    <div class="td">
                        {{$list->user_name}}
                    </div>
                    <div class="td">
                        {{$list->user_name_english}}
                    </div>
                    <div class="td">
                        {{$list->tel}}
                    </div>
                    <div class="td text-center">
                        <a class="btn btn-primary" href="{{route('admin.company.edit', $list['id'])}}">編集</a>
                        <br /><br />

                        {{Form::open(['route'=>['admin.company.destroy',$list['id']],'method'=>'DELETE', 'class' => 'inline-block  destory'])}}
                        <a class="ml btn btn-danger destory" href="#" target="{{route('admin.company.destroy', $list['id'])}}?_method=delete">削除</a>
                        {{Form::close()}}
                    </div>

                </div>
                @endforeach
            </div>


            <div class="mt text-center">
                @include('layouts.parts.navi')
            </div>
        </div>

</div>
@endsection
