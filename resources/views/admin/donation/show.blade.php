@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">  عرض الطلب </h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')

                    @csrf

            <div class="card-body">
                <div class="table-responsive">
                        <ul>
                            <li>الاسم : {{$donations->patient_name}} </li>
                            <hr>

                            <li>التليفون : {{$donations->patient_phone}}</li>
                            <hr>

                            <li>العمر : {{$donations->age}}</li>
                            <hr>

                            <li>عدد الأكياس المطلوبه : {{$donations->bags_num}}</li>
                            <hr>

                            <li>فصيلة الدم : {{$donations->BloodType->name}}</li>
                            <hr>

                            <li>اسم المستشفي : {{$donations->hospital_name}}</li>
                            <hr>

                            <li>العنوان : {{$donations->hospital_address}}</li>
                            <hr>

                            <li>التفاصيل : {{$donations->details}}</li>
                            <hr>

                            <li>المدينه : {{$donations->city->name}}</li>
                            <hr>

                            <li>العميل : {{$donations->client->name}}</li>
                            <hr>
                        </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
