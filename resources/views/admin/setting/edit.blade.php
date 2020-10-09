@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">  تعديل الاعدادات </h6> <br>
                </div>
            </div>
            <div class="box-body">
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <div class="card-body">
                    <form action="{{route('setting.update',$settings->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$settings->id}}"> {{-- عشان الصوره لو محبتش اغيرها --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#about">عن التطبيق </label>
                                <textarea class="form-control" id="about" rows="3" name="about_app" >{{$settings->about_app}}</textarea>
                                @error("about_app")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#about">وصف كبير عن التطبيق  </label>
                                <textarea class="form-control" id="about" rows="3" name="long_desc" >{{$settings->long_desc}}</textarea>
                                @error("long_desc")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="#about"> وصف صفير عن التطبيق  </label>
                                <textarea class="form-control" id="about" rows="3" name="small_desc" >{{$settings->small_desc}}</textarea>
                                @error("small_desc")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط الفيس </label>
                                <input class="form-control" type="text" name="fb_url" value="{{$settings->fb_url}}">
                                @error("fb_url")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط تويتر </label>
                                <input class="form-control" type="text" name="tw_url" value="{{$settings->tw_url}}">
                                @error("tw_url")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div> <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط اليوتيوب </label>
                                <input class="form-control" type="text" name="youtube_url" value="{{$settings->youtube_url}}">
                                @error("youtube_url")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div> <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط الانستجرام </label>
                                <input class="form-control" type="text" name="insta_url" value="{{$settings->insta_url}}">
                                @error("insta_url")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div> <div class="col-md-12">
                            <div class="form-group">
                                <label>الفون </label>
                                <input class="form-control" type="text" name="phone" value="{{$settings->phone}}">
                                @error("phone")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الايميل </label>
                                <input class="form-control" type="text" name="email" value="{{$settings->email}}">
                                @error("email")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-icon-split" type="submit" >
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text"> عدل فصيلة</span>
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
