@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">  طلبات التبرع <small style="color:black;">{{$donations -> count()}}</small></h6>  <br>
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
                                    <label> اختر الفصيله</label>
                                    <select class="form-control" name="blood_type_id">
                                        <optgroup label="من فضلك اختر المدينه للبحث عنها"></optgroup>
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
                            <div class="row">
                                <label> التاريخ من  </label>
                                <div class="col-md-4">
                                    <input type="date" name = 'from' class="form-control" >
                                 </div>
                                <label> التاريخ الي  </label>
                                <div class="col-md-4">
                                    <input type="date" name = 'to' class="form-control" >
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
                    @if(isset($donations)&&count($donations))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المريض </th>
                            <th>رقم هاتف المريض </th>
                            <th>المدينه التابعه له </th>
                            <th>فصليه الدم </th>
                            <th>اسم المستشفي </th>
                            <th>عنوان المستشفي </th>
                            <th>عمره </th>
                            <th>عدد الاكياس </th>
                            <th>التفاصيل </th>
                            <th>اضيف فيه </th>
                            <th>العميل </th>
                            <th>الحذف </th>
                            <th>عرض التفاصيل</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($donations as $index=> $donation)

                            <td>{{$index +1 }}</td>
                            <td>{{$donation ->patient_name}}</td>
                            <td>{{$donation ->patient_phone}}</td>
                            <td>{{$donation ->city->name}}</td>
                            <td>{{$donation ->bloodType->name}}</td>
                            <td>{{$donation ->hospital_name}}</td>
                            <td>{{$donation ->hospital_address}}</td>
                            <td>{{$donation ->age}}</td>
                            <td>{{$donation ->bags_num}}</td>
                            <td>{{$donation ->details}}</td>
                            <td>{{$donation ->created_at}}</td>
                            <td>{{$donation ->client-> name}}</td>
                            <td>
                                <form action="{{route('donation.destroy',$donation->id)}}" method="post" >
                                    {{csrf_field()}}
                                    {{method_field('delete')}}

                                    <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                                <td>
                                    <a class="btn btn-primary btn-circle btn-lg" href="{{route('donation.show',$donation->id)}}"><i class=" fas fa-eye"></i></a>
                                </td>

                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$donations->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
