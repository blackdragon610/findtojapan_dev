@extends('layouts/admin', ['pageType' => 1, 'isLayoutList' => true])

@section('header')
	@parent
@endsection

@section('main')

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="mt">
                    <h2 class="title2">検索</h2>
                    {{Form::open(['url'=> route('admin.language.index'),'method'=>'GET', 'id' => 'form'])}}
                    <input type="hidden" name="search" value="1" />
                    <table class="table">
                        <tr class="tr">
                            <th class="th">言語</th>
                            <td class="td">
                                @include('layouts.parts.editor.select', ['name' => 'language', "file" => configJson("lang_type"), "keyValue" => "", 'contents' => 'class="form-control" placeholder=""'])
                            </td>
                            <th class="th">変換元</th>
                            <td class="td">
                                @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'from', 'contents' => 'class="form-control" placeholder=""'])
                            </td>
                        </tr>


                        <tr class="tr">
                            <th class="th">変換後</th>
                            <td class="td">
                                @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'body', 'contents' => 'class="form-control" placeholder=""'])
                            </td>
                        </tr>
                    </table>

                    <div class="text-center">
                        <button class="btn btn-primary">検索する</button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </section>
  <section class="content">
    <div class="box">
      <div class="box-body">
		<div class="mt">
			@include('layouts.parts.message')

            <h2 class="title2">一覧</h2>

            <div class="text-right">
                <a href="{{route("admin.language.create")}}" class="btn btn-primary">新規登録</a>
            </div>
            <br /><br />
            <div class="text-right">
                <a href="{{route("admin.language.google")}}" class="btn btn-success">Googleから再取得</a>
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
                        言語
                    </div>
                    <div class="th">
                        変換元
                    </div>
                    <div class="th">
                        変換後
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
                        {{configJson("lang_type")[$list->language]}}
                    </div>
                    <div class="td">
                        {{$list->from}}
                    </div>
                    <div class="td">
                        {{$list->body}}
                    </div>

                    <div class="td text-center">
                        <a class="btn btn-primary" href="{{route('admin.language.edit', $list['id'])}}">編集</a>


                        {{Form::open(['route'=>['admin.language.destroy',$list['id']],'method'=>'DELETE', 'class' => 'inline-block  destory'])}}
                        <a class="ml btn btn-danger destory" href="#" target="{{route('admin.language.destroy', $list['id'])}}?_method=delete">削除</a>
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
