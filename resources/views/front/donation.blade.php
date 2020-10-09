@extends('layouts.master')

@section('content')

    <div class="container">
        <!--Breadcrumb-->
        <nav class="my-5" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('client/home')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item">المقالات</li>

            </ol>
        </nav><!--End Breadcrumb-->
    </div><!--End container-->

    <!--Donation-->
    <section class="donation">
        <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
        <hr />
        <div class="donation-request py-5">

            <div class="container">
                <form action="" metod="get">
                    @csrf
                <div class="selection w-75 d-flex mx-auto my-4">
                    <select class="custom-select" name="blood_type">
                        <option class="hidden" >اختر الفصيلة</option>
                        @foreach($bloodTypes as $bloodType)
                            <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                        @endforeach
                    </select>
                    <select class="custom-select mx-md-3 mx-sm-1" name="city">
                        <option class="hidden"  >اختر المدينة</option>
                        @foreach($cities as $city )
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div><button class="btn btn-circle" type="submit"><i type="submit" class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
                <!--End selection-->
                @if(isset($donations)&&count($donations))
                @foreach($donations as $don)
                <div class="req-item my-3">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 clearfix">
                            <div class="blood-type m-1 float-right">
                                <h3>{{$don->bloodType->name}}</h3>
                            </div>
                            <div class="mx-3 float-right pt-md-2">
                                <p>
                                    اسم الحالة : {{$don->patient_name}}
                                </p>
                                <p>
                                    مستشفى : {{$don->hospital_name}}
                                </p>
                                <p>
                                    المدينة : {{$don->city->name}}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
                            <a href="Status-detailes.html" class="btn btn-light px-5 py-3">التفاصيل</a>
                        </div>
                    </div>
                </div>
                @endforeach
                   {{$donations->appends(request()->query())->links()}}
                @else
                    <h2>Data Not Found</h2>
                @endif
            </div>
            <!--End container-->
        </div>
        <!--End Donation-request-->
    </section>
    <!--End Donation-->
    <!--Footer-->
@endsection
