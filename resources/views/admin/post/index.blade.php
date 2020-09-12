@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">   المقالات <small style="color:black;">{{$posts -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')
                <form action="" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="search" value="" >
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="category_id">
                                <optgroup label="من فضلك اختر القسم للبحث عنها"></optgroup>
                                <option class="hidden">-----</option>
                                @foreach($categories as $category)

                                <option value="{{ $category->id}}">
                                    {{$category ->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> search</button>
                            @if(auth()->user()->hasPermission('create_posts'))
                            <a class="btn btn-primary " href="{{route('post.create')}}"><i class="fa fa-plus"></i> أضف</a>
                            @else
                                <a class="btn btn-primary disabled " href=""><i class="fa fa-plus"></i> أضف</a>
                            @endif
                        </div>

                    </div> {{-- end  row--}}

                </form> {{-- end form --}}

            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($posts)&&count($posts))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>القسم</th>
                            <th>العنوان</th>
                            <th>البوست</th>
                            <th>التعديل</th>
                            <th>الحذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($posts as $index=> $post)

                            <td>{{$index +1 }}</td>
                            <td><img src="{{$post->photo}}" style="width: 100px;height: 100px"></td>
                            <td>{{$post ->category->name}}</td>
                            <td>{{$post ->title}}</td>
                            <td>{{$post ->contents}}</td>
                            <td>
                                @if(auth()->user()->hasPermission('update_posts'))
                                <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-circle btn-lg"><i class="fas fa-info-circle"></i></a>
                                @else
                                    <a href="" class="btn btn-primary btn-circle btn-lg disabled"><i class="fas fa-info-circle"></i></a>
                                @endif
                            </td>

                                <td>
                                    @if(auth()->user()->hasPermission('delete_posts'))

                                    <form action="{{route('post.destroy',$post->id)}}" method="post" >
                                        {{csrf_field()}}
                                        {{method_field('delete')}}

                                        <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                        <a href="" class="btn btn-danger btn-circle btn-lg disabled"></a>
                                    @endif
                                </td>
                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$posts->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
