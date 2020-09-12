@extends('layouts.master')
@section('content')
    <!--main-header-->
    <div class="main-header">
        <div class="slide">
            <img src="{{asset('assets/front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}</p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
        <div class="slide">
            <img src="{{asset('assets/front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}</p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
        <div class="slide">
            <img src="{{asset('assets/front/imgs/header.jpg')}}" class="d-block w-100" alt="...">
            <div class="slick-caption">
                <h4 class="my-md-3">{{$settings->small_desc}}</h4>
                <p class="pl-md-5">{{$settings->about_app}}</p>
                <button class="btn bg px-5">المزيد</button>
            </div>
        </div>
    </div>
    <!--End main-header-->
    <!--About section-->
    <section class="about py-5">
        <div class="container">
            <div class="about-cont py-3">
                <p class="pl-4"><span> بنك الدم</span> {{$settings->long_desc}}
                </p>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End About-->
    <!--Articles section-->
    <section class="articles py-5">
        <div class="title">
            <div class="container">
                <h2><span class="py-1">المقالات</span> </h2>
            </div>
            <hr />
        </div>
        <div class="article-slide mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="arrow text-left">
                            <button type="button" class="prev-arrow px-2 py-1"><i
                                    class="fas fa-chevron-right"></i></button>
                            <button type="button" class="next-arrow px-2 py-1"><i
                                    class="fas fa-chevron-left"></i></button>
                        </div>
                    </div>
                </div>
                <div class="slick2">
                    @foreach($posts as $post)
                    <div class="slick-cont">
                        <div class="card">
                            <img src="{{$post->photo}}" class="card-img-top" alt="slick-img" style="width:330px;height: 200px; ">
                            <div class="heart-icon"><i class="far fa-heart"></i></div>
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p>{{ mb_substr($post ->contents,0,70)}} ......
                                </p>
                                <div class="text-center"><a href="{{route('details-posts',$post->id)}}" class="btn bg px-5">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Articles-->
    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">
            <div class="container">
                <div class="selection w-75 d-flex mx-auto my-4">
                    <select class="custom-select">
                        <option selected>اختر فصيلة الدم</option>
                        <option value="+AB">+AB</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="B+">B+</option>
                    </select>
                    <select class="custom-select mx-md-3 mx-sm-1">
                        <option selected>اختر المدينة</option>
                        <option value="القاهرة">القاهرة</option>
                        <option value="الجيزة">الجيزة</option>
                        <option value="القليوبيه">القليوبيه</option>
                        <option value="سوهاج">سوهاج</option>
                    </select>
                    <div><i class="fas fa-search"></i></div>
                </div>
                <!--End selection-->
                <div id="donations">

                    @foreach($donations as $donation)
                    <div class="req-item my-3">
                        <div class="row">
                            <div class="col-md-9 col-sm-12 clearfix">
                                <div class="blood-type m-1 float-right"><h3>{{$donation->bloodType->name}}</h3></div>
                                <div class="mx-3 float-right pt-md-2"><p>اسم الحالة : {{$donation->patient_name}}</p>
                                    <p>مستشفى : {{$donation->hospital_name}}</p>
                                    <p>المدينة : {{$donation->city->name}}</p></div>
                            </div>
                            <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5"><a
                                    href=""
                                    class="btn btn-light px-5 py-3">التفاصيل</a>
                            </div>
                        </div>
                        @endforeach

                    </div>

                <!--End last req-item-->
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
    <!--Contact-us-->
    <section class="contact-us py-5 mt-4">
        <div class="container">
            <div class="row">
                <div class="contact-info col-md-6 col-sm-12 text-center">
                    <h4 class="text-center"><span class="brd">اتصل بنا </span> </h4>
                    <p class="my-5">يمكنك الأتصال بنا للاستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="phone-nm mx-auto">
                        <p class="text-right" href=""><span class=""></span> {{$settings->phone}}</p>
                        <img src="{{asset('assets/front/imgs/whats.png')}}" alt="whats-phone">
                    </div>
                </div>
            </div>
        </div>
        <!--End container-->
    </section>
    <!--End Contact-us-->
    <!--blood-app-->
    <section class="blood-app py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mt-5 mb-4">تطبيق بنك الدم</h4>
                    <p class="appText">{{$settings->about_app}}</p>
                    <div class="text-center avilb">
                        <h5 class="my-4">متوفر على</h5>
                        <img src="{{asset('assets/front/imgs/google.png')}}" alt="">
                        <img src="{{asset('assets/front/imgs/ios.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 my-3"><img src="{{asset('assets/front/imgs/App.png')}}" class="img-fluid" alt=""></div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>
    <!--End blood-app-->



    {{--<script>
        var request = new XMLHttpRequest();

        var url = "https://cors-anywhere.herokuapp.com/" + "http://ipda3-tech.com/blood-bank/api/v1/donation-requests?api_token=W4mx3VMIWetLcvEcyF554CfxjZHwdtQldbdlCl2XAaBTDIpNjKO1f7CHuwKl&page=1";

        request.open('GET', url);

        request.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var dataHolder = JSON.parse(this.responseText);
                var div = document.getElementById('donations');
                var temp = "";
                for (var i = 0; i < dataHolder['data'].data.length; i++) {
                    temp += '<div class="req-item my-3"><div class="row"><div class="col-md-9 col-sm-12 clearfix"><div class="blood-type m-1 float-right"><h3>' + dataHolder['data'].data[i].blood_type.name + '</h3></div><div class="mx-3 float-right pt-md-2"><p>اسم الحالة : ' + dataHolder['data'].data[i].patient_name + '</p><p>مستشفى : ' + dataHolder['data'].data[i].hospital_name + '</p><p>المدينة : ' + dataHolder['data'].data[i].city.name + '</p></div></div><div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5"><a href="Status-detailes.html" class="btn btn-light px-5 py-3">التفاصيل</a></div></div></div>';
                }


                div.innerHTML = temp;
                // console.log(dataHolder);


            }
        };

        request.send();

    </script>--}}

@endsection
