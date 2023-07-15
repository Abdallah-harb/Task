@extends('Dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Add new User!</h2>
						</div>
					</div>

				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
    <div >
        <div class="row">
            <div class="col-xl-12 mb-30">
                <form action="{{route('store.user')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="title">name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="title">email</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="title">password</label>
                            <input type="text" name="password" class="form-control">
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="inputCity">data</label>
                            <input type="date" name="data" class="form-control"  value="{{old('data')}}">
                            @error('data')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="title">image</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-success" type="submit">submit</button>
                    <br>
                </form>
            </div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
@endsection
