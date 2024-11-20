@extends('admin.layout')

@section('CustomCss')
@endsection

<link href="plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard/User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add_User</h3>
                    </div>



                    <div class="card-body">
                        <form action="{{ route('admin.storeUser') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="text" class="form-control" name = "name" id="exampleInputEmail1"
                                            placeholder="Enter Username"
                                            style="@error('name')
                                                border: 2px solid red
                                            @enderror" value="{{old('name')}}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" name = "email" id="exampleInputEmail1"
                                            placeholder="@Example.com"
                                            style="@error('email')
                                                border: 2px solid red
                                            @enderror" value="{{old('email')}}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" class="form-control" name = "address" id="exampleInputEmail1"
                                            placeholder="Enter Address"
                                            style="@error('address')
                                                    border: 2px solid red
                                                @enderror" value="{{old('address')}}">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone_Number</label>
                                        <input type="number" class="form-control" name = "phone" id="exampleInputEmail1"
                                            placeholder="344_4344_54"
                                            style="@error('phone')
                                                border: 2px solid red
                                            @enderror" value="{{old('phone')}}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Generate_Password</label>
                                        <input type="password" class="form-control" name = "password"
                                            id="exampleInputEmail1" placeholder="**************"
                                            style="@error('password')
                                                    border: 2px solid red
                                                @enderror">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Role_As</label>
                                        <select name="role" class="form-control" id=""
                                            style="@error('role')
                                   border: 2px solid red
                               @enderror">
                                            <option value="" disabled selected>--Select_User_Role--</option>
                                            <option value="editor">Editor</option>
                                            <option value="user">Viewer</option>
                                        </select>
                                        @error('role')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </section>
    </div>
    </div>



    </div>
@endsection

@section('CustomJs')
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
