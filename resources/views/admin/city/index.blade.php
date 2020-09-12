@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">   المدن <small style="color:black;">{{$cities -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <form action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="search" value="" >

                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="governorate_id">
                                <optgroup label="من فضلك اختر المحافظه للبحث عنها"></optgroup>
                                <option class="hidden">-----</option>
                                @foreach($governorates as $governorate)

                                <option value="{{ $governorate->id}}">
                                    {{$governorate ->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> search</button>
                            @if(auth()->user()->haspermission('create_cities'))
                                <a class="btn btn-primary " href="{{route('cities.create')}}"><i class="fa fa-plus"></i> أضف</a>
                            @else
                                <a class="btn btn-primary disabled " href=""><i class="fa fa-plus"></i> أضف</a>
                            @endif

                        </div>

                    </div> {{-- end  row--}}

                </form> {{-- end form --}}

            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($cities)&&count($cities))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>المحافظه</th>
                            <th>التعديل</th>
                            <th>الحذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($cities as $index=> $city)

                            <td>{{$index +1 }}</td>
                            <td>{{$city ->name}}</td>
                            <td>{{$city ->governorate->name}}</td>
                            <td>
                                @if(auth()->user()->haspermission('update_cities'))
                                    <a href="{{route('cities.edit',$city->id)}}"   class="btn btn-primary btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                                @else
                                    <a class="btn btn-primary btn-circle btn-lg disabled " href=""><i class="fas fa-info-circle"></i></a>
                                @endif
                            </td>

                                <td>
                                    @if(auth()->user()->haspermission('delete_cities'))
                                        <form action="{{route('cities.destroy',$city->id)}}" method="post" >
                                            {{csrf_field()}}
                                            {{method_field('delete')}}

                                            <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a class="btn btn-danger btn-circle btn-lg disabled " href=""><i class="fas fa-trash"></i> </a>
                                    @endif


                                </td>
                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$cities->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
