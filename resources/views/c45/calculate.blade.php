@extends('pages.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Calculate C45
            <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data tables</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                    <div class="box-header">
                        <div class="col-xs-10"><h3 class="box-title">Calculate C45 Data</h3></div>
                        
                        <div class="col-xs-2">
                            <div class="float-right">
                            <a href="{{url('/calculate/generate')}}" class="btn btn-primary pull-right">G E N E R A T E <span class="fa fa-plus"></span></a>    
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- <div class="box-body ">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>PEG#</th>
                            <th>Name</th>
                            <th>EPR 1</th>
                            <th>EPR 2</th>
                            <th>EPR 3</th>
                            <th>EPR 4</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @if(!empty($data))
                                @foreach($data as $value)
                                    <tr>
                                        <th>{{$i}}</th>
                                        <th>{{$value['no_peg']}}</th>
                                        <th>{{$value['name']}}</th>
                                        <th>{{$value['epr1']}}</th>
                                        <th>{{$value['epr2']}}</th>
                                        <th>{{$value['epr3']}}</th>
                                        <th>{{$value['epr4']}}</th>
                                        <th>{{($value['status']==2)?"DIUSULKAN":"DIREKOMENDASIKAN"}}</th>
                                    </tr>
                                    <?php $i++;?>
                                @endforeach
                            @endif        
                        </tbody>
                        </table>
                    </div> -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>PEG#</th>
                                <th>Name</th>
                                <th>EPR 1</th>
                                <th>EPR 2</th>
                                <th>EPR 3</th>
                                <th>EPR 4</th>
                                <th>Result</th>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @if(!empty($data))
                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$value['no_peg']}}</td>
                                            <td>{{$value['name']}}</td>
                                            <td>{{$value['epr1']}}</td>
                                            <td>{{$value['epr2']}}</td>
                                            <td>{{$value['epr3']}}</td>
                                            <td>{{$value['epr4']}}</td>
                                            <td>{{($value['status']==2)?"DIUSULKAN":"DIREKOMENDASIKAN"}}</td>
                                        </tr>
                                        <?php $i++;?>
                                    @endforeach
                                @endif        
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection     