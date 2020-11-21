@extends('layouts/admin', ['pageType' => 1, 'isLayoutEdit' => true])


@section('main')

    <section class="content">

        <div class="box">
            <div class="box-body">

                @if (!empty($id))
                    {{Form::open(['url'=> route('admin.company.update', $id),'method'=>'PUT', 'files' => true, 'id' => 'form'])}}
                    <input type="hidden" name="id" value="{{$id}}" />
                @else
                    {{Form::open(['url'=> route('admin.company.store'),'method'=>'POST', 'files' => true, 'id' => 'form'])}}
                @endif



            <div class="mt">
                <table class="table mt">
                    @include('layouts.parts.inputs.company')
                </table>


                @if (empty($isConfirmation))
                    <div class="mt-lg">
                        <div class="row">
                            <div class="col-xs-50 text-center">
                                <a href="{{route('admin.company.index')}}" class="btn btn-block btn-default" style="display:block;">一覧</a>
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
