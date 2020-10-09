@extends('layouts.master')

@section('content')
    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->
    <section class="signup text-center">
        @include('admin.includes.alerts.errors')
        @include('admin.includes.alerts.success')
        <div class="container">
            <div class="py-4 mb-4">
        <form action="{{route('front.register')}}" method="POST" class="w-75 m-auto">
            @csrf

            <div class="form-group">
                <input type="text" name="name" class="form-control my-3" placeholder="الاسم">
                <div class="input-group">
                @error("name")
                <span class="text-danger">{{$message}} </span>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control my-3" placeholder="البريد الاليكترونى">
                <div class="input-group">
                @error("email")
                <span class="text-danger">{{$message}} </span>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="text"  id="datepicker" name="dop" class="form-control" placeholder="تاريخ الميلاد">
                    <i class="far fa-calendar-alt"></i>
                    <div class="input-group">
                    @error("dop")
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <select name="blood_type_id" id="blood_type" class="form-control custom-select">
                        <option selected>المدينة</option>
                        @if(isset($bloodTypes)&&count($bloodTypes))
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                    <div class="input-group">
                @error("blood_type_id")
                <span class="text-danger">{{$message}} </span>
                @enderror
                </div>
            </div>
            <div class="form-group">
            <div class="input-group">
                <div class="input-group mb-3">
                    <select name="governorate_id" id="capital" class="custom-select form-control">
                        <optgroup label="من فضلك أختر القسم">

                        <option>------</option>
                        @if(isset($governorates)&&count($governorates))
                        @foreach($governorates as $gov)
                            <option value="{{$gov->id}}">{{$gov->name}}</option>
                        @endforeach
                        @endif
                        </optgroup>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                    <div class="input-group">
                    @error("governorate_id")
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    </div>

                </div>
            </div>
            </div>
            <div class="form-group">
            <div class="input-group">
                <select name="city_id" id="city" class="form-control custom-select">
                    <option selected>المدينة</option>
                    @if(isset($cities)&&count($cities))
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    @endif
                </select>
                <i class="fas fa-chevron-down"></i>
                <div class="input-group">
                @error("city_id")
                <span class="text-danger">{{$message}} </span>
                @enderror
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                <input type="text" name="phone" class="form-control my-3" placeholder="رقم الهاتف">
                </div>
                    <div class="input-group">
                    @error("phone")
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                    </div>
            </div>
            <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" id="datepicker" name="last_donation_date" class="form-control" placeholder="اخر تاريخ تبرع" aria-label="Username" aria-describedby="basic-addon1">
                <i class="far fa-calendar-alt"></i>
                <div class="input-group">
                    <div class="input-group">
                @error("last_donation_date")
                <span class="text-danger">{{$message}} </span>
                @enderror
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                <input type="password" name="password" class="form-control my-3" placeholder="كلمة المرور">
                <div class="input-group">
                    @error("password")
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                </div>
                </div>
            </div>
          <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control my-3" placeholder="تأكيد كلمة المرور">
            <div class="input-group">
              @error("password_confirmation")
            <span class="text-danger">{{$message}} </span>
            @enderror
            </div>

          </div>
            <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
        </form>
            </div>
        </div>

    </section>
@endsection
