@extends('pages.main')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            C45
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
            <!-- <div class="col-xs-12">
                <a href="{{url('/c45/add')}}" class="btn btn-primary"><span class="fa fa-plus"></span></a>    
            </div> -->
            <div class="col-xs-12">
                <div class="box">
                <div class="box-header">
                    <div class="col-xs-10"><h3 class="box-title">C45 Data</h3></div>
                    
                    <div class="col-xs-2">
                        <div class="float-right">
                        <a href="{{url('/c45/add')}}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span></a>    
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body ">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>PEG#</th>
                        <th>Name</th>
                        <th>Code#</th>
                        <th>Code</th>
                        <th>Gender</th>
                        <th>PERSG</th>
                        <th>PERSK</th>
                        <th>CTR#</th>
                        <th>CTR</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @if(!empty($data))
                            @foreach($data as $value)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value['no_peg']}}</td>
                                    <td>{{$value['name']}}</td>
                                    <td>{{$value['code']}}</td>
                                    <td>{{$value['code_text']}}</td>
                                    <td>{{$value['gender']}}</td>
                                    <td>{{$value['persg']}}</td>
                                    <td>{{$value['persk']}}</td>
                                    <td>{{$value['ctr']}}</td>
                                    <td>{{$value['ctr_text']}}</td>
                                    <td>{{$value['year']}}</td>
                                    <td>
                                        <a href="{{url('c45/edit/').'/'.$value['id']}}"><span class="fa fa-pencil"></span></a>
                                        <a href="{{url('c45/delete/').'/'.$value['id']}}" onclick="return confirm('Are you sure you want to delete this item?');"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach
                        @endif        
                    </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection     