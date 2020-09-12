@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">  اضف فصيلة </h6> <br>
                </div>
            </div>
            <div class="box-body">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <div class="card-body">
                <form action="{{route('blood-types.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>اسم الفصيلة </label>
                            <input class="form-control" type="text" name="name" value="{{old('name')}}">
                            @error("name")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-icon-split" type="submit" >
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text"> أضف فصيلة </span>
                                </button>
                            </div>
                        </div>
                </form>
            </div>{{--end box body--}}
        </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
