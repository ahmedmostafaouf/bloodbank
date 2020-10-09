@extends('layouts.master')

@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('client-home')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">اتصل بنا</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="contact py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 my-1">
                        <div class="contact-details">
                            <h5 class="py-3 text-center">اتصل بنا</h5>
                            <div class="text-center py-3"><img src="{{asset('assets/front/imgs/logo.png')}}" alt="img-logo"></div>
                            <div class="contact-mail p-3">
                                <p class="py-1">الجوال <span> : {{$settings->phone}}</span></p>
                                <p class="py-1">فاكس <span> : 4123412</span></p>
                                <p class="py-1">البريد الاليكترونى <span> : {{$settings->email}}</span></p>
                            </div>
                            <div class="contact-social text-center">
                                <h6 class="py-2"> تواصل معنا</h6>
                                <ul class="list-unstyled d-flex justify-content-center py-md-3">
                                    <li class="ml-2"><a class="google" href=""target="_blank"><i class="fab fa-google-plus-square"></i></a></li>
                                    <li class="mx-2"><a class="whatsapp" href=""target="_blank"><i class="fab fa-whatsapp-square"></i></a></li>
                                    <li class="mx-2"><a class="insta" href="{{$settings->insta_url}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li class="mx-2"><a class="youtube" href="{{$settings->youtube_url}}"target="_blank"><i class="fab fa-youtube-square"></i></a></li>
                                    <li class="mx-2"><a class="twitter" href="{{$settings->tw_url}}"target="_blank"><i class="fab fa-twitter-square"></i></li>
                                    <li class="mr-2"><a class=" facebook" href="{{$settings->fb_url}}"target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-1">
                        <div class="contact-form text-center">
                            <h5 class="py-3">تواصل معنا</h5>
                            <form action="{{route('push.contact')}}" method="POST">
                                @csrf
                                @include('admin.includes.alerts.errors')
                                @include('admin.includes.alerts.success')
                                <input type="text"  value="{{request()->user()->name}}" class="form-control my-3 " disabled>
                                <input type="mail"  value="{{request()->user()->email}}" class="form-control my-3" disabled>
                                <input type="text"  value="{{request()->user()->phone}}" class="form-control my-3" disabled>
                                <input type="text" name="subject" class="form-control my-3" placeholder="عنوان الرسالة">
                                <div class="form-group">
                                @error("subject")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>
                                <textarea name="message" class="form-control my-4" rows="5" placeholder="نص الرسالة"></textarea>
                                <div class="form-group">
                                @error("message")
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                                </div>

                                <button type="submit" class="btn py-3 bg w-100 ">ارسال</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div><!--End container-->
@endsection
