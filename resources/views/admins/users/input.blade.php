@extends('layouts/admin', ['pageType' => 1, 'isLayoutEdit' => true])


@section('main')

    <section class="content">

        <div class="box">
            <div class="box-body">

                @if (!empty($id))
                    {{Form::open(['url'=> route('admin.user.update', $id),'method'=>'PUT', 'files' => true, 'id' => 'form'])}}
                @else
                    {{Form::open(['url'=> route('admin.user.store'),'method'=>'POST', 'files' => true, 'id' => 'form'])}}
                @endif



            <div class="mt">
                @if (isset($inputs["count_like"]))
                    <table class="table mt">
                        <tr class="tr">
                            <th class="th" style="width:22%">いいねをもらった数</th>
                            <td class="td">{{$inputs["count_like"]}}</td>
                            <th class="th" style="width:22%">フォロワー数</th>
                            <td class="td">{{$inputs["count_follower"]}}</td>
                        </tr>
                        <tr class="tr">
                            <th class="th" style="width:22%">ポイント数</th>
                            <td class="td">{{$inputs["point"]}}</td>
                            <th class="th" style="width:22%">ランク</th>
                            <td class="td">@if ($inputs->rank){{$inputs->rank->rank_name}}@endif</td>
                        </tr>
                    </table>
                @endif




                <table class="table mt">

                    <tr class="tr">
                        <th class="th">ユーザー名</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'user_name', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                        <th class="th">メールアドレス</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "email", 'name' => 'email', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">電話番号</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "tel", 'name' => 'tel', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                        <th class="th">画像</th>
                        <td class="td">
                            @include('layouts.parts.editor.file', ["type" => "image", 'name' => 'image', "dir" => getUploadType("User"),  'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">一言メッセージ</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'message', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                        <th class="th">PR</th>
                        <td class="td">
                            @include('layouts.parts.editor.textarea', ['name' => 'pr',  'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>




                </table>


                @if (empty($isConfirmation))
                    <div class="mt-lg">
                        <div class="row">
                            <div class="col-xs-50 text-center">
                                <a href="{{route('admin.qa.index')}}" class="btn btn-block btn-default" style="display:block;">一覧</a>
                            </div>

                            <div class="col-xs-50 text-center">
                                <button class="btn btn-block btn-primary">@if (!empty($id))編集@else登録@endif</button>
                            </div>
                        </div>

                    </div>
                @else

                    <div class="row mt">
                        <div class="col-xs-50 text-center">
                            {!! Form::submit('修正', ['class' => 'btn btn-block btn-default', 'name' => 'reInput']) !!}
                        </div>
                        <div class="col-xs-50 text-center">
                            {!! Form::submit('確定', ['class' => 'btn btn-block btn-primary', 'name' => 'end']) !!}
                        </div>
                    </div>

                @endif
                {{Form::close()}}
            </div>
</section>




@endsection
