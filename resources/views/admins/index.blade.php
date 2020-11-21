@extends('layouts/admin', ['pageType' => 1])


@section('main')


    <section class="content-header">
      <h1>
        Dashboard
        <small>ダッシュボード</small>
      </h1>
    </section>


        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-33 col-xs-50">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$countCompany}}</h3>

                            <p>店舗数</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route("admin.company.index")}}" class="small-box-footer">もっと見る<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-33 col-xs-50">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$countPost}}</h3>

                            <p>投稿数</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route("admin.post.index")}}" class="small-box-footer">もっと見る <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-33 col-xs-50">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$countUser}}</h3>

                            <p>ユーザー数</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route("admin.user.index")}}" class="small-box-footer">もっと見る<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


        </section>
    </div>
@endsection
