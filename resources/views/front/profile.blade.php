@extends('layouts.master')

@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('client-home')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="donation.html">الملف الشخصى</a></li>
                <li class="breadcrumb-item active" aria-current="page">معلومات  عن : {{auth()->user()->name}}</li>
            </ol>
        </nav><!--End Breadcrumb-->
        <section class="Status-details">
            <div class="container">
                <div class="Status-info p-3 my-4">
                    <div class="row">
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">الأسم</p>
                            <p class="status-item float-right p-3">{{auth()->user()->name}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">فصيلة الدم</p>
                            <p class="status-item float-right p-3">{{auth()->user()->bloodType->name}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">العمر</p>
                            <p class="status-item float-right p-3">{{\Carbon\Carbon::parse(auth()->user()->dop)->diff(\Carbon\Carbon::now())->format('%y')}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">الأميل</p>
                            <p class="status-item float-right p-3">{{auth()->user()->email}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">المدينة</p>
                            <p class="status-item float-right p-3">{{auth()->user()->city->name}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">المحافظة</p>
                            <p class="status-item float-right p-3">{{auth()->user()->governorate->name}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">رقم الجوال</p>
                            <p class="status-item float-right p-3">{{auth()->user()->phone}}</p>
                        </div>
                        <div class="col-md-6 clearfix">
                            <p class="status float-right p-3">اخر تاريخ تبرع بالدم</p>
                            <p class="status-item float-right p-3">{{\Carbon\Carbon::parse(auth()->user()->last_donation_date)->diff(\Carbon\Carbon::now())->format('%y سنة, %m شهر و %d يوم')}}
                            </p>
                        </div>
                    </div><!--End row-->
                    <div class="text-center my-3"><button type="button" class="btn bg px-5">التفاصيل</button></div>
                    <div class="border p-3 my-3">
                        <div class="container">
                                <form action="{{route('edit.client.profile')}}" method="POST" class="w-75 m-auto">

                                    <input type="hidden" name="id" value="{{request()->user()->id}}">
                                    @csrf
                                    @include('admin.includes.alerts.errors')
                                    @include('admin.includes.alerts.success')
                                    <div class="form-group">
                                        <label>الاسم  </label>
                                        <input class="form-control" type="text" value="{{request()->user()->name}}" name="name" >
                                        @error("name")
                                        <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الاليكترونى </label>
                                        <input type="text" name="email" value="{{request()->user()->email}}" class="form-control">
                                            @error("email")
                                            <span class="text-danger">{{$message}} </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label >تاريخ الميلاد</label>
                                            <input type="date"  id="datepicker" name="dop" value="{{request()->user()->dop}}" class="form-control">
                                            <div class="input-group">
                                                @error("dop")
                                                <span class="text-danger">{{$message}} </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label>اسم الفصيلة </label>
                                        <select name="blood_type_id" id="blood_type" class="custom-select">
                                                <option selected>فصيله الدم</option>
                                                @if(isset($bloodTypes)&&count($bloodTypes))
                                                    @foreach($bloodTypes as $bloodType)
                                                        <option value="{{$bloodType->id}}" @if($bloodType->id==request()->user()->blood_type_id )selected @endif>{{$bloodType->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                                @error("blood_type_id")
                                                <span class="text-danger">{{$message}} </span>
                                                @enderror
                                        </div>
                                    <div class="form-group">
                                        <label>المحافظه </label>

                                        <select name="governorate_id" id="capital" class="custom-select">
                                                        <option selected>المحافظه</option>
                                                        @if(isset($governorates)&&count($governorates))
                                                            @foreach($governorates as $gov)
                                                                <option value="{{$gov->id}}" @if($gov->id==request()->user()->governorate_id )selected @endif>{{$gov->name}}</option>
                                                            @endforeach
                                                        @endif
                                        </select>
                                                    @error("governorate_id")
                                                    <span class="text-danger">{{$message}} </span>
                                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>المدينة </label>
                                        <select name="city_id" id="city" class="custom-select">
                                                <option selected>المدينة</option>
                                                @if(isset($cities)&&count($cities))
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}" @if($city->id==request()->user()->city_id )selected @endif>{{$city->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                                @error("city_id")
                                                <span class="text-danger">{{$message}} </span>
                                                @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>رقم الهاتف </label>
                                        <input type="text" name="phone" class="form-control " value="{{request()->user()->phone}}">
                                        @error("phone")
                                        <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>أخر تاريخ للتبرع </label>
                                        <input type="date" id="datepicker" name="last_donation_date" value="{{request()->user()->last_donation_date}}" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                                    @error("last_donation_date")
                                                    <span class="text-danger">{{$message}} </span>
                                                    @enderror
                                    </div>
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control">ارسال</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <!--Location on Google-->
            </div><!--End Container-->
        </section><!--End Status section-->
    </div><!--End container-->
@endsection
