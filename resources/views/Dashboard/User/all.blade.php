@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">Customer Ratings</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">Online Sales</label>
							<h5>563,275</h5>
						</div>
						<div>
							<label class="tx-13">Offline Sales</label>
							<h5>783,675</h5>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
    <div >
        <a class="btn btn-primary" href="{{route('create.user')}}">Create New Data</a>

        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>data</th>
                                    <th>image</th>
                                    <th>Process</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->data}}</td>
                                        <td>
                                            @if(!empty($user->image))
                                                <img src="{{asset('image/'.$user->image)}}" width="50px" height="80px">
                                            @else
                                                <img src="{{asset('image/anime.jpeg')}}" width="50px" height="80px">
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $user->id }}"
                                                    title="Edit"><i
                                                    class="fa fa-edit"></i>Edit </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $user->id }}"
                                                    title="delete"><i
                                                    class="fa fa-trash"></i>Delete</button>                                        </td>
                                    </tr>

                                    <!-- edit_modal_User -->
                                    <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        Edit
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{route('update.user',$user->id )}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $user->id }}">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="name"
                                                                       class="mr-sm-2">name
                                                                    :</label>
                                                                <input id="name" type="text" name="name"
                                                                       class="form-control"
                                                                       value="{{$user->name}}"
                                                                       required>

                                                            </div>
                                                            <div class="col">
                                                                <label for="email"
                                                                       class="mr-sm-2">email
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$user->email}}"
                                                                       name="email" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        @if(!empty($user->image))
                                                            Current Image
                                                            <img src="{{asset('image/'.$user->image)}}" width="50px" height="80px">
                                                        @else
                                                        @endif
                                                        <br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="data"
                                                                       class="mr-sm-2">data
                                                                    :</label>
                                                                <input type="data" class="form-control"
                                                                       value="{{$user->data}}"
                                                                       name="data" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="data"
                                                                       class="mr-sm-2">New Image
                                                                    :</label>
                                                                <input type="file" name="image" accept="image/*" class="form-control">
                                                            </div>

                                                        </div>
                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                    class="btn btn-success">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--delete_user--}}
                                    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        Delete
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('delete.user',$user->id)}}" method="post">
                                                        @csrf
                                                        Waning You Delete User
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $user->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">close</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('Dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('Dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('Dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
