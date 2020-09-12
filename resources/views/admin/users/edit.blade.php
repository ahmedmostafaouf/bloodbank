@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> تعديل مشرف </h6> <br>
                </div>
            </div>
            <div class="box-body">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <div class="card-body">
                    <form action="{{route('users.update',$users->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <input type="hidden" name="idd" value="{{$users->id}}"> {{-- عشان الصوره لو محبتش اغيرها --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الاسم الاول </label>
                                <input class="form-control" type="text" name="first_name" value="{{$users->first_name}}">
                                @error("first_name")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 " >
                            <div class="form-group">
                                <label for="governorate">الاسم الثاني </label>
                                <input class="form-control" type="text" name="last_name" value="{{$users->last_name}}">
                                @error("last_name")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 " >
                            <div class="form-group">
                                <label for="governorate">الاميل </label>
                                <input class="form-control" type="text" name="email" value="{{$users->email}}">
                                @error("email")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>الصالحيات</label>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @php
                                    $models=['users','governorates','cities','bloodTypes','categories','posts'];
                                    $maps=['create','read','update','delete']
                                @endphp
                                @foreach($models as $index=>$model)
                                    <li class="nav-item"><a id="{{$model}}-tab" class="nav-link {{$index==0?'active':''}} " href="#{{$model}}" data-toggle="tab" role="tab" aria-controls="{{$model}}" aria-selected="true"> {{$model}} </a></li>
                                @endforeach
                            </ul>
                            <br>
                            <div class="tab-content" id="myTabContent">
                                @foreach($models as $index=>$model)
                                    <div class="tab-pane fade show {{$index==0?'active':''}}" id="{{$model}}" role="tabpanel" aria-labelledby="{{$model}}-tab">
                                        <div class="form-group">
                                            @foreach($maps as $index=>$map)
                                                <label class="form-check-label" for="exampleCheck1"><input type="checkbox" class="form-check-inline" id="exampleCheck1" name="permission[]" {{$users->hasPermission($map.'_'.$model)?"checked":''}} value="{{ $map.'_'.$model }}"> {{$map}}</label>
                                            @endforeach
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-icon-split" type="submit" >
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text"> تعديل مشرف</span>
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
