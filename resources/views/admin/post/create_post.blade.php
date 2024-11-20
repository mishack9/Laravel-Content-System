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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard/Post</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Content Post Here</h3>
                    </div>

                    <form action="{{ route('admin.storePost') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Post Title</label>
                                <input type="text" class="form-control" name = "title" id="exampleInputEmail1"
                                    placeholder="Enter Post Title"
                                    style="@error('title')
                                                border: 2px solid red
                                            @enderror">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Catergories</label>
                                <select name="catergory_id" class="form-control"
                                    style="@error('catergory_id')
                                             border:2px solid red
                                         @enderror">
                                    <option value="" disabled selected>--Select Catergory--</option>
                                    @foreach ($data as $catergory)
                                        <option value="{{ $catergory->id }}">{{ $catergory->name }}</option>
                                    @endforeach
                                </select>
                                @error('catergory_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tag</label>
                                <input type="text" class="form-control" name = "name" id="exampleInputEmail1"
                                    placeholder="Enter Post Tag"
                                    style="@error('name')
                                                border: 2px solid red
                                            @enderror">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Post Content</label>
                                <textarea id="editor" cols="50" placeholder="Enter Post Description" name = "content" class = "form-control"
                                    rows="10"
                                    style="@error('content')
                                       border: 2px solid red
                                       @enderror"></textarea> 
                                    @error('content')
                                           <div class="text-danger">{{ $message }}</div>
                                       @enderror
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name = "status" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Status</label>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?command=QuickUpload&type=Images&responseType=json'
                },
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    'imageUpload'
                ],
                image: {
                    toolbar: ['imageTextAlternative', 'imageStyle:full', 'imageStyle:side']
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
