@extends('pages.main')

@section('content')   
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                C45
                <small>Form</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">C45</li>
            </ol>
        </section>

            <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            

            <div class="row">
                <div class="col-md-12">

                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Import Data</h3>
                        </div>
                        <div class="box-body">
                            <form class="ui form" action="{{ url('c45/import') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_requestToken" value="{{ bcrypt(csrf_token().time()) }}">
                            <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>File</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="I M P O R T" class="btn btn-primary pull-right">
                                </div>
                            </form>    
                        <!-- /.form group -->

                        </div>
                        <!-- /.box-body -->
                    </div>
                <!-- /.box -->

                </div>
        <!-- /.col (right) -->
            </div>
        <!-- /.box -->

        <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Form</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form class="ui form" action="{{ url('c45/save') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_requestToken" value="{{ bcrypt(csrf_token().time()) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Peg#</label>
                                    <input type="text" name="no_peg" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code#</label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code_text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control select2" name="gender" style="width: 100%;">
                                        <option selected="selected" value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>PERSG</label>
                                    <select class="form-control select2" name="persg" style="width: 100%;">
                                        <option selected="selected" value="0">Pegawai Tetap</option>
                                        <option value="1">PHK</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>PERSK</label>
                                    <input type="text" name="persk" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>CTR#</label>
                                    <input type="text" name="ctr" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>CTR</label>
                                    <input type="text" name="ctr_text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Join Date</label>
                                    <input type="date" name="join_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BOD</label>
                                    <input type="date" name="birth_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Age</label>
                                    <input type="number" name="age" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Position#</label>
                                    <input type="text" name="position" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" name="position_text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control select2" name="year" style="width: 100%;">
                                        <option value=""></option>
                                        @for($i=2000;$i<=2020;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>EPR1</label>
                                    <input type="text" name="epr1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>EPR2</label>
                                    <input type="text" name="epr2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>EPR3</label>
                                    <input type="text" name="epr3" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>EPR4</label>
                                    <input type="text" name="epr4" class="form-control">
                                </div>
                            </div>
                            <!-- /.col -->
                            
                            <!-- /.col -->
                        </div class="col-md-12">
                            <a href="{{url('/c45')}}" class="btn btn-default pull-left">C A N C E L</a>
                            <input type="submit" class="btn btn-primary pull-right" value="S A V E">
                        </div>
                    </form>    
                </div>
                <!-- /.box-body -->
            </div>

        </section>
        
        <!-- /.content -->
    </div>
@endsection       