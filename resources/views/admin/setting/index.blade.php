@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">  الاعدادات <small style="color:black;">{{$settings -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')


            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($settings)&&count($settings))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عن التطبيق </th>
                            <th><i class="fab fa-facebook fa-2x"></i></th>
                            <th><i class="fab fa-twitter fa-2x"></i></th>
                            <th><i class="fab fa-youtube fa-2x"></i></th>
                            <th><i class="fab fa-instagram fa-2x"></i></th>
                            <th>الاميل </th>
                            <th>الفون </th>
                            <th>تعديل </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($settings as $index=> $setting)

                            <td>{{$index +1 }}</td>
                            <td>{{$setting ->about_app}}</td>
                            <td>{{$setting ->fb_url}}</td>
                            <td>{{$setting ->tw_url}}</td>
                            <td>{{$setting ->youtube_url}}</td>
                            <td>{{$setting ->insta_url}}</td>
                            <td>{{$setting ->email}}</td>
                            <td>{{$setting ->phone}}</td>
                            <td>
                                <a href="{{route('setting.edit',$setting->id)}}"   class="btn btn-primary btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                            </td>

                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$settings->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
