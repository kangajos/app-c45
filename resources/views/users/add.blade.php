@extends('pages.main')

@section('content')   
   <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Form</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>
            </ol>
        </section>

            <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            

            
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
                    <form class="ui form" action="{{ url('users/save') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_requestToken" value="{{ bcrypt(csrf_token().time()) }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <!-- /.col -->
                            
                            <!-- /.col -->
                        </div class="col-md-12">
                            <a href="{{url('/users')}}" class="btn btn-default pull-left">C A N C E L</a>
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