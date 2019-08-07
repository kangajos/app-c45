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
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th colspan="2">Type</th>
                                <th>Total</th>
                                <th>Rekomendasi(s1)</th>
                                <th>Diusulkan(s2)</th>
                                <th>Entrophy</th>
                                <th>Gain</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2">1</td>
                                    <td rowspan="2">Gender</td>
                                    <td>Male</td>
                                    <td>{{$data['gender']['Male']['gender']}}</td>
                                    <td>{{$data['gender']['Male']['rekom']}}</td>
                                    <td>{{$data['gender']['Male']['usul']}}</td>
                                    <td>{{$data['gender']['Male']['entropy']}}</td>
                                    <td rowspan="2">{{$data['gender']['gain']}}</td>
                                </td>
                                <tr>
                                    <td>Female</td>
                                    <td>{{$data['gender']['Female']['gender']}}</td>
                                    <td>{{$data['gender']['Female']['rekom']}}</td>
                                    <td>{{$data['gender']['Female']['usul']}}</td>
                                    <td>{{$data['gender']['Female']['entropy']}}</td>
                                </tr>
                                <tr>
                                    <td rowspan="4">2</td>
                                    <td rowspan="4">Transformasi EPR1</td>
                                    <td>Kurang Baik</td>
                                    <td>{{$data['epr1']['Kurang Baik']['count']}}</td>
                                    <td>{{$data['epr1']['Kurang Baik']['rekom']}}</td>
                                    <td>{{$data['epr1']['Kurang Baik']['usul']}}</td>
                                    <td>{{$data['epr1']['Kurang Baik']['entropy']}}</td>
                                    <td rowspan="4">{{$data['epr1']['gain']}}</td>
                                </td>
                                <tr>
                                    <td>Cukup Baik</td>
                                    <td>{{$data['epr1']['Cukup Baik']['count']}}</td>
                                    <td>{{$data['epr1']['Cukup Baik']['rekom']}}</td>
                                    <td>{{$data['epr1']['Cukup Baik']['usul']}}</td>
                                    <td>{{$data['epr1']['Cukup Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Baik</td>
                                    <td>{{$data['epr1']['Baik']['count']}}</td>
                                    <td>{{$data['epr1']['Baik']['rekom']}}</td>
                                    <td>{{$data['epr1']['Baik']['usul']}}</td>
                                    <td>{{$data['epr1']['Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Sangat Baik</td>
                                    <td>{{$data['epr1']['Sangat Baik']['count']}}</td>
                                    <td>{{$data['epr1']['Sangat Baik']['rekom']}}</td>
                                    <td>{{$data['epr1']['Sangat Baik']['usul']}}</td>
                                    <td>{{$data['epr1']['Sangat Baik']['entropy']}}</td>
                                </tr>  
                                <tr>
                                    <td rowspan="4">3</td>
                                    <td rowspan="4">Transformasi EPR2</td>
                                    <td>Kurang Baik</td>
                                    <td>{{$data['epr2']['Kurang Baik']['count']}}</td>
                                    <td>{{$data['epr2']['Kurang Baik']['rekom']}}</td>
                                    <td>{{$data['epr2']['Kurang Baik']['usul']}}</td>
                                    <td>{{$data['epr2']['Kurang Baik']['entropy']}}</td>
                                    <td rowspan="4">{{$data['epr2']['gain']}}</td>
                                </td>
                                <tr>
                                    <td>Cukup Baik</td>
                                    <td>{{$data['epr2']['Cukup Baik']['count']}}</td>
                                    <td>{{$data['epr2']['Cukup Baik']['rekom']}}</td>
                                    <td>{{$data['epr2']['Cukup Baik']['usul']}}</td>
                                    <td>{{$data['epr2']['Cukup Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Baik</td>
                                    <td>{{$data['epr2']['Baik']['count']}}</td>
                                    <td>{{$data['epr2']['Baik']['rekom']}}</td>
                                    <td>{{$data['epr2']['Baik']['usul']}}</td>
                                    <td>{{$data['epr2']['Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Sangat Baik</td>
                                    <td>{{$data['epr2']['Sangat Baik']['count']}}</td>
                                    <td>{{$data['epr2']['Sangat Baik']['rekom']}}</td>
                                    <td>{{$data['epr2']['Sangat Baik']['usul']}}</td>
                                    <td>{{$data['epr2']['Sangat Baik']['entropy']}}</td>
                                </tr>   
                                <tr>
                                    <td rowspan="4">4</td>
                                    <td rowspan="4">Transformasi EPR3</td>
                                    <td>Kurang Baik</td>
                                    <td>{{$data['epr3']['Kurang Baik']['count']}}</td>
                                    <td>{{$data['epr3']['Kurang Baik']['rekom']}}</td>
                                    <td>{{$data['epr3']['Kurang Baik']['usul']}}</td>
                                    <td>{{$data['epr3']['Kurang Baik']['entropy']}}</td>
                                    <td rowspan="4">{{$data['epr3']['gain']}}</td>
                                </td>
                                <tr>
                                    <td>Cukup Baik</td>
                                    <td>{{$data['epr3']['Cukup Baik']['count']}}</td>
                                    <td>{{$data['epr3']['Cukup Baik']['rekom']}}</td>
                                    <td>{{$data['epr3']['Cukup Baik']['usul']}}</td>
                                    <td>{{$data['epr3']['Cukup Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Baik</td>
                                    <td>{{$data['epr3']['Baik']['count']}}</td>
                                    <td>{{$data['epr3']['Baik']['rekom']}}</td>
                                    <td>{{$data['epr3']['Baik']['usul']}}</td>
                                    <td>{{$data['epr3']['Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Sangat Baik</td>
                                    <td>{{$data['epr3']['Sangat Baik']['count']}}</td>
                                    <td>{{$data['epr3']['Sangat Baik']['rekom']}}</td>
                                    <td>{{$data['epr3']['Sangat Baik']['usul']}}</td>
                                    <td>{{$data['epr3']['Sangat Baik']['entropy']}}</td>
                                </tr>   
                                <tr>
                                    <td rowspan="4">5</td>
                                    <td rowspan="4">Transformasi EPR4</td>
                                    <td>Kurang Baik</td>
                                    <td>{{$data['epr4']['Kurang Baik']['count']}}</td>
                                    <td>{{$data['epr4']['Kurang Baik']['rekom']}}</td>
                                    <td>{{$data['epr4']['Kurang Baik']['usul']}}</td>
                                    <td>{{$data['epr4']['Kurang Baik']['entropy']}}</td>
                                    <td rowspan="4">{{$data['epr4']['gain']}}</td>
                                </td>
                                <tr>
                                    <td>Cukup Baik</td>
                                    <td>{{$data['epr4']['Cukup Baik']['count']}}</td>
                                    <td>{{$data['epr4']['Cukup Baik']['rekom']}}</td>
                                    <td>{{$data['epr4']['Cukup Baik']['usul']}}</td>
                                    <td>{{$data['epr4']['Cukup Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Baik</td>
                                    <td>{{$data['epr4']['Baik']['count']}}</td>
                                    <td>{{$data['epr4']['Baik']['rekom']}}</td>
                                    <td>{{$data['epr4']['Baik']['usul']}}</td>
                                    <td>{{$data['epr4']['Baik']['entropy']}}</td>
                                </tr> 
                                <tr>
                                    <td>Sangat Baik</td>
                                    <td>{{$data['epr4']['Sangat Baik']['count']}}</td>
                                    <td>{{$data['epr4']['Sangat Baik']['rekom']}}</td>
                                    <td>{{$data['epr4']['Sangat Baik']['usul']}}</td>
                                    <td>{{$data['epr4']['Sangat Baik']['entropy']}}</td>
                                </tr>     
                            </tbody>
                            <tfoot>
                                <th colspan="3">Total</th>
                                <th>{{$data['total']['total']}}</th>
                                <th>{{$data['total']['rekom']}}</th>
                                <th>{{$data['total']['usul']}}</th>
                                <th colspan="2">{{$data['total']['entropy']}}</th>
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