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
                    <form action="{{route('post.update',$posts->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$posts->id}}"> {{-- عشان الصوره لو محبتش اغيرها --}}
                        <div class="form-group">
                            <div class="text-center">
                                <img src="{{$posts->photo}}"
                                     class="rounded-circle" style="width: 200px;height: 200px" alt="صوره القسم">
                            </div>
                        </div>

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
                                                <option value="{{$category->id}}" @if($category->id==$posts->category_id )selected @endif>{{$category->name}}</option>
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
                                <input class="form-control" type="text" name="title" value="{{$posts->title}}">
                                @error("title")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#content">المقالة </label>
                                <textarea class="form-control" id="content" rows="3" name="contents" >{{$posts->contents}}</textarea>
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
