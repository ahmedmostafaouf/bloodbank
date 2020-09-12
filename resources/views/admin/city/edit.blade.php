@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">  اضف محافظة </h6> <br>
                </div>
            </div>
            <div class="box-body">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <div class="card-body">
                    <form action="{{route('cities.update',$cities->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$cities->id}}"> {{-- عشان الصوره لو محبتش اغيرها --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم المدينة </label>
                                <input class="form-control" type="text" name="name" value="{{$cities->name}}">
                                @error("name")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 " >
                            <div class="form-group">
                                <label for="governorate">اسم المحافظة </label>
                                <select name="governorate_id" class="select2 form-control" id="#governorate">
                                    <optgroup label="من فضلك أختر المحافظه  ">
                                        @if(isset($governorates)&&count($governorates))
                                            @foreach($governorates as $governorate)
                                                <option value="{{$governorate->id}}" @if($governorate->id ==$cities->governorate_id)selected @endif>{{$governorate->name}}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
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
                                    <span class="text"> أضف مدينة</span>
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
