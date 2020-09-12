@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">   المحافظات <small style="color:black;">{{$categories -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <form action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="search" value="" >

                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> search</button>
                            @if(auth()->user()->haspermission('create_categories'))
                                <a class="btn btn-primary " href="{{route('category.create')}}"><i class="fa fa-plus"></i> أضف</a>
                            @else
                                <a class="btn btn-primary disabled " href=""><i class="fa fa-plus"></i> أضف</a>
                            @endif


                        </div>

                    </div> {{-- end  row--}}
                </form> {{-- end form --}}

            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($categories)&&count($categories))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>التعديل</th>
                            <th>الحذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($categories as $index=> $category)

                            <td>{{$index +1 }}</td>
                            <td>{{$category ->name}}</td>
                            <td>
                                @if(auth()->user()->haspermission('update_categories'))
                                    <a href="{{route('category.edit',$category->id)}}"   class="btn btn-primary btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                                @else
                                    <a href=""   class="btn btn-primary btn-circle btn-lg disabled"><i class="fas fa-info-circle"></i></a>
                                @endif
                            </td>

                                <td>
                                    @if(auth()->user()->haspermission('delete_categories'))
                                        <form action="{{route('category.destroy',$category->id)}}" method="post" >
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
                    {{$categories->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
