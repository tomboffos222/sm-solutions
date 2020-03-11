@extends('layouts.appAdmin')


@section('content')

    <div class="content-wrapper pl-5 pr-5 pt-5">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$balance}} KZT<sup style="font-size: 20px"></sup></h3>

                        <p>Общий балас</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>




                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$cats}}<sup style="font-size: 20px"></sup></h3>

                        <p>Количество курсов</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>


                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$courses}}</h3>

                        <p>Количество видео</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$online}}</h3>

                        <p>Количество пользователей</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
