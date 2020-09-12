@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">   المشرفين <small style="color:black;">{{$users -> count()}}</small></h6>  <br>
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
                            @if(auth()->user()->hasPermission('create_users'))

                                <a class="btn btn-primary " href="{{route('users.create')}}"><i class="fa fa-plus"></i> أضف</a>
                            @else
                                <a class="btn btn-primary disabled" href=""><i class="fa fa-plus  "></i> أضف</a>
                            @endif
                        </div>

                    </div> {{-- end  row--}}

                </form> {{-- end form --}}

            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($users)&&count($users))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم الاول</th>
                            <th>الاسم الاخير</th>
                            <th>الاميل</th>
                            <th>التعديل</th>
                            <th>الحذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($users as $index=> $user)

                            <td>{{$index +1 }}</td>
                            <td>{{$user ->first_name}}</td>
                            <td>{{$user ->last_name}}</td>
                            <td>{{$user ->email}}</td>
                            <td>
                                @if(auth()->user()->hasPermission('update_users'))
                                <a href="{{route('users.edit',$user->id)}}"  class="btn btn-primary btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                                @else
                                    <a href=""  class="btn btn-primary btn-circle btn-lg disabled"><i class="fas fa-info-circle"></i></a>
                                @endif

                            </td>

                                <td>
                                    @if(auth()->user()->hasPermission('delete_users'))

                                    <form action="{{route('users.destroy',$user->id)}}" method="post" >
                                        {{csrf_field()}}
                                        {{method_field('delete')}}

                                        <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                        </button>
                                        @else
                                            <button type="submit" class="btn btn-danger btn-circle btn-lg disabled"> <i class="fas fa-trash"></i>
                                        @endif
                                    </form>
                                </td>
                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$users->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
