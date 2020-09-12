@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">  اضف مقاله </h6> <br>
                </div>
            </div>
            <div class="box-body">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <div class="card-body">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> صور المقاله </label>
                        <label class="file center-block">
                            <input type="file" id="file" name="photo">
                            <span class="file-custom"></span>
                        </label>
                        @error('photo')
                        <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>

                    <div class="col-md-12 " >
                        <div class="form-group">
                            <label for="#category">اسم القسم </label>
                            <select name="category_id" class="select2 form-control" id="#category">
                                <optgroup label="من فضلك أختر القسم  ">
                                    <option>------</option>
                                @if(isset($categories)&&count($categories))
                                    @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                               @endif
                                </optgroup>
                            </select>
                            @error("category_id")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> عنوان المقالة </label>
                            <input class="form-control" type="text" name="title" value="{{old('title')}}">
                            @error("title")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="#contents">المقالة </label>
                            <textarea class="form-control" id="contents" rows="3" name="contents" ></textarea>
                            @error("content")
                            <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-icon-split" type="submit" >
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text"> أضف مقالة</span>
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
