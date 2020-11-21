@extends('layouts/company', ['pageType' => 1, 'isLayoutEdit' => true])


@section('main')

    <section class="content">

        <div class="box">
            <div class="box-body">

                @if (!empty($id))
                    {{Form::open(['url'=> route('company.event.update', $id),'method'=>'PUT', 'files' => true, 'id' => 'form'])}}
                @else
                    {{Form::open(['url'=> route('company.event.store'),'method'=>'POST', 'files' => true, 'id' => 'form'])}}
                @endif



            <div class="mt">
                <table class="table mt">

                    <tr class="tr">
                        <th class="th">イベントのタイトル</th>
                        <td class="td" colspan="3">
                            @include('layouts.parts.editor.text', ["type" => "text", 'name' => 'event_name', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">終了日</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "date", 'name' => 'date_limit', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                        <th class="th">終了時間</th>
                        <td class="td">
                            @include('layouts.parts.editor.text', ["type" => "time", 'name' => 'time_limit', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>
                    <tr class="tr">
                        <th class="th">イベントの内容</th>
                        <td class="td" colspan="3">
                            @include('layouts.parts.editor.editor', ["type" => "text", 'name' => 'body', 'contents' => 'class="form-control" placeholder=""'])
                        </td>
                    </tr>
                </table>


                @if (empty($isConfirmation))
                    <div class="mt-lg">
                        <div class="row">
                            <div class="col-xs-50 text-center">
                                <a href="{{route('company.event.index')}}" class="btn btn-block btn-default" style="display:block;">一覧</a>
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
