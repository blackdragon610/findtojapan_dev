@extends('layouts/admin', ['pageType' => 1, 'isLayoutEdit' => true])


@section('main')

    <section class="content">

        <div class="box">
            <div class="box-body">

                @if (!empty($id))
                    {{Form::open(['url'=> route('admin.page.update', $id),'method'=>'PUT', 'files' => true, 'id' => 'form'])}}
                @else
                    {{Form::open(['url'=> route('admin.page.store'),'method'=>'POST', 'files' => true, 'id' => 'form'])}}
                @endif



            <div class="mt">
                <div class="table mt">

                    <div class="tr">
                        <div class="th">種別のID</div>
                        <div class="td">
                            @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'type', 'contents' => 'class="form-control" placeholder=""'])
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">タイトル</div>
                        <div class="td">
                            @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'page_name', 'contents' => 'class="form-control" placeholder=""'])
                        </div>
                    </div>


                    <div class="tr">
                        <div class="th">本文</div>
                        <div class="td">
                            @include('layouts.parts.editor.editor', ['name' => 'body', 'contents' => 'class="form-control" placeholder=""'])
                        </div>
                    </div>
                </div>


                @if (empty($isConfirmation))
                    <div class="mt-lg">
                        <div class="row">
                            <div class="col-xs-50 text-center">
                                <a href="{{route('admin.page.index')}}" class="btn btn-block btn-default" style="display:block;">一覧</a>
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
