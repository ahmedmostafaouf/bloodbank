@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">   العملاء <small style="color:black;">{{$clients -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <form action="" method="get">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="search" class="form-control" placeholder="search" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>اختر المدينه</label>
                                <select class="form-control" name="city_id">
                                    <optgroup label="من فضلك اختر المدينه للبحث عنها"></optgroup>
                                    <option class="hidden">-----</option>
                                    @foreach($cities as $city)

                                        <option value="{{ $city->id}}">
                                            {{$city->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>اختر المحافظه</label>
                                <select class="form-control" name="governorate_id">
                                    <optgroup label="من فضلك اختر المحافظه للبحث عنها"></optgroup>
                                    <option class="hidden">-----</option>
                                    @foreach($governorates as $governorate)

                                        <option value="{{ $governorate->id}}">
                                            {{$governorate->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label> اختر الفصيله</label>
                                <select class="form-control" name="blood_type_id">
                                    <optgroup label="من فضلك اختر الفصيله للبحث عنها"></optgroup>
                                    <option class="hidden">-----</option>
                                    @foreach($bloodTypes as $bloodType)

                                        <option value="{{ $bloodType->id}}">
                                            {{$bloodType->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> search</button>
                        </div>
                    </div>
                </form> {{-- end form --}}

            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($clients)&&count($clients))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم </th>
                            <th>الاميل</th>
                            <th>فصيله الدم</th>
                            <th>تاريخ الميلاد</th>
                            <th>أخر تاريخ للتبرع</th>
                            <th>المحافظه</th>
                            <th>المدينة</th>
                            <th>رقم الهاتف</th>
                            <th>الحالة</th>
                            <th>اجراء الحالة</th>
                            <th>الحذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($clients as $index=> $client)

                            <td>{{$index +1 }}</td>
                            <td>{{$client ->name}}</td>
                            <td>{{$client ->email}}</td>
                            <td>{{$client ->bloodType->name}}</td>
                            <td>{{$client ->dop}}</td>
                            <td>{{$client ->last_donation_date}}</td>
                            <td>{{$client ->governorate->name}}</td>
                            <td>{{$client ->city->name}}</td>
                            <td>{{$client ->phone}}</td>
                            <td>{{$client ->getStatus()}}</td>
                            <td>
                                <a href="{{route('clients.status',$client->id)}}"
                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">@if($client->status==0) تفعيل @else  الغاء تفعيل @endif </a>                            </td>

                                <td>

                                    <form action="{{route('clients.destroy',$client->id)}}" method="post" >
                                        {{csrf_field()}}
                                        {{method_field('delete')}}

                                        <button type="submit" class="btn btn-outline-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                </td>
                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$clients->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
