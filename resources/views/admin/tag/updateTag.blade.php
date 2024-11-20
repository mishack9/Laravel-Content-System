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
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard/Update-Tag</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="content">
                    <div class="container">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Tag</h3>
                            </div>
        
                            <form action="{{route('admin.updateTag',$data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tag Name</label>
                                        <input type="text" class="form-control" value="{{$data->name}}" name = "name" id="exampleInputEmail1"
                                            placeholder="Enter Post Title" style="@error('name')
                                                border: 2px solid red
                                            @enderror">
                                            @error('name')
                                               <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                   
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"name = "status" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Status</label>
                                    </div>
                                </div>
        
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </section>

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
