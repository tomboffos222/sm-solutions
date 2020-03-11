@extends('layouts.app')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Приборная панель ваш id: {{$user->id}}</h1>
                        <button class="btn btn-success mt-3 mb-3" data-toggle="modal" data-target="#cash">
                            Пополнить баланс
                        </button>
                        <div class="modal fade" id="cash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title col-black" id="exampleModalLabel" style="color:black;"> Создание аккаунта</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('RefillBalance')}}" method="get">


                                            <div class="form-group">
                                                <input type="number" class="form-control" name="amount" value="Введите сумму пополнения " placeholder="Сумма">
                                            </div>
                                            <div class="">
                                                <input type="submit" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Приборная панель</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$user->balance}}</h3>

                                <p>Мой баланс</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">Узнать больше <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success" >
                            <div class="inner" data-toggle="modal" data-target="#newModal" style="cursor:pointer;">
                                <h3>{{$accountsNum}}<sup style="font-size: 20px"></sup></h3>

                                <p>Мои аккаунты</p>
                            </div>
                            <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title col-black" id="exampleModalLabel" style="color:black;"> Создание аккаунта</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped" style="color:black;">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        ID
                                                    </th>
                                                    <th>
                                                        Имя
                                                    </th>
                                                    <th>
                                                        Статус
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($accounts as $account)
                                                <tr>
                                                    <td>
                                                        {{$account->login}}
                                                    </td>
                                                    <td>
                                                        {{$account->name}}
                                                    </td>
                                                    <td>
                                                        @if($account->cell_count == 2)
                                                            Занято
                                                            @elseif($account->cell_count  ==1)
                                                            Осталось одно место
                                                            @else
                                                            Осталось 2 места
                                                            @endif
                                                    </td>
                                                </tr>

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#exampleModal">Купить аккаунт <i class="fas fa-arrow-circle-right"></i></a>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title col-black" id="exampleModalLabel" style="color:black;"> Создание аккаунта</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('AccountCreate')}}" method="get">

                                                <div class="form-group">
                                                    <input type="number" name="referBy" class="form-control mb-2" placeholder="Введите Id консультанта">
                                                    <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                                                </div>
                                                <div class="">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$cell}}</h3>

                                <p>Мои пользователи</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">Узнать больше <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Мои курсы
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Бесплатные</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Платные</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart  tab-pane active " id="revenue-chart"
                                         style="position: relative; ">
                                        <iframe  src="https://www.youtube.com/embed/iR9WzyX37Vw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



                                        <iframe src="https://www.youtube.com/embed/i2bFAA9_X4k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="chart tab-pane " id="sales-chart" style="position: relative; height: 300px;">
                                       <div class="d-flex justify-content-between align-items-center ">
                                           @foreach($courses as $course)
                                               <iframe src="{!! $course->url !!}"width="45%" height="200px" controls controlsList="nodownload">

                                               </iframe>
                                           @endforeach
                                       </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->

                        <!--/.direct-chat -->

                        <!-- TO DO List -->

                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">

                        <!-- Map card -->
                        <div class="card bg-gradient-primary">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    Мои пользователи
                                </h3>
                                <!-- card tools -->
                                <div class="card-tools">

                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">
                                <div id="world-map" class="users active" style="overflow:auto;height: 250px; width: 100%;">
                                    <table class="table table-striped">
                                        @foreach($refers as $refer)
                                            <tr>
                                                <td>
                                                    {{$refer->name}}
                                                </td>
                                                <td>{{$refer->login}}</td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                                <div id="world-map" class="accounts" style="overflow:auto;height: 250px; width: 100%;">
                                    <table class="table table-striped">
                                        @foreach($accounts as $account)
                                            <tr>
                                                <td data-toggle="modal" data-target="#exampleModal_{{$account->id}}" style="cursor:pointer">
                                                    {{$account->name}}
                                                </td>
                                                <td data-toggle="modal" data-target="#exampleModal_{{$account->id}}" style="cursor:pointer">{{$account->cell_count}}</td>
                                                <div class="modal fade" id="exampleModal_{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title col-black" id="exampleModalLabel" style="color:black;">Пользователи {{$account->name}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('RefillBalance')}}" method="get">


                                                                    <div class="form-group">
                                                                        @foreach($linkers as $linker)
                                                                            @if($linker['referBy'] == $account['id'])
                                                                                <div class="d-flex mb-2 justify-content-between" style="color:black;">
                                                                                    <span>{{$linker['name']}}</span><span>{{$linker['login']}}</span>
                                                                                </div>


                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="">

                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>

                                        @endforeach

                                    </table>

                                </div>
                            </div>
                            <!-- /.card-body-->
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center ">
                                        <div id="sparkline-1"></div>
                                        <div class="text-white users_controller">Пользователи</div>

                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div class="text-white accounts_controller">Мои аккаунты</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3"></div>

                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.card -->

                        <!-- solid sales graph -->

                        <!-- /.card -->

                        <!-- Calendar -->

                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <style>
        .new_panel {
            height: 200px;
            display: flex !important;
            justify-content: space-between;
        }
        .new_panel iframe{
            width: 30%;
            height: 100%;
        }
        .users.active, .accounts.active{
            display: block;
        }
        .accounts, .users {
            display: none;
        }
        .accounts_controller:hover,.users_controller:hover{
            cursor:pointer;
        }
        @media(max-width:720px)
        {
            .new_panel{
                flex-flow: column;
                height: 400px;

            }
            .new_panel iframe{
                width: 100%;
                height: 45%;
            }
        }


    </style>
    <!-- /.content-wrapper -->


@endsection
