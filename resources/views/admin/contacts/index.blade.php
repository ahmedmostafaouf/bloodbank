@extends('layouts.admin')

@section('content')

    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">  التقارير <small style="color:black;">{{$contacts -> count()}}</small></h6>  <br>
                @include('admin.includes.alerts.errors')
                @include('admin.includes.alerts.success')


            </div>

            <div class="card-body">


                <div class="table-responsive">
                    @if(isset($contacts)&&count($contacts))
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الموضوع </th>
                            <th>الرساله </th>
                            <th>حذف </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            @foreach($contacts as $index=> $contact)

                            <td>{{$index +1 }}</td>
                            <td>{{$contact ->subject}}</td>
                            <td>{{$contact ->message}}</td>
                            <td>
                                <form action="{{route('reports.destroy',$contact->id)}}" method="post" >
                                    {{csrf_field()}}
                                    {{method_field('delete')}}

                                    <button type="submit" class="btn btn-danger btn-circle btn-lg"> <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>


                        @endforeach

                        </tbody>
                    </table>
                    {{$contacts->appends(request()->query())->links()}}
                    @else
                        <h2>data not found</h2>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
