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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard/Post</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <div class="container">

                                <div class="card card-primary mb-5">
                                    <div class="card-header">
                                        <h3 class="card-title">Update Media Post Here</h3>
                                        <div class="card-tools"><a href="{{route('admin.viewMediaPost',$data->id)}}" class="btn btn-info">Go_Back</a></div>
                                    </div>

                                    <form action="{{ route('admin.updateMediaPost',$data->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            
                                            <div class="row">
                                                
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Update Post Title</label>
                                                    <input type="text" class="form-control" name = "title"
                                                        id="exampleInputEmail1" placeholder="Enter Post Title"
                                                        style="@error('title')
                                                            border: 2px solid red
                                                        @enderror" value="{{old('title',$data->title)}}">
                                                    @error('title')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Update Catergories</label>
                                                <select name="catergory_id" class="form-control"
                                                    style="@error('catergory_id')
                                                     border:2px solid red
                                                 @enderror">
                                                    <option value="" disabled selected>--Select Catergory--</option>
                                                    @foreach ($data_cat as $catergory)
                                                        <option value="{{ $catergory->id }}" {{$data->catergory_id == $catergory->id ? 'selected' : ''}}>{{ $catergory->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('catergory_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                           </div>
                                            </div>

                                           
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tag</label>
                                                    <input type="text" class="form-control" name = "name"
                                                        id="exampleInputEmail1" placeholder="Enter Post Tag"
                                                        style="@error('name')
                                                            border: 2px solid red
                                                        @enderror">
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                           

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Update Post Content</label>
                                                <textarea id="content" cols="50" placeholder="Enter Post Description" name = "content" class = "form-control"
                                                    rows="10"
                                                    style="@error('content')
                                               border: 2px solid red
                                               @enderror">{{old('content',$data->content)}}</textarea>
                                                @error('content')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="yu">File</label>
                                                <input type="file" class="form-control" name = "file_path[]"
                                                    id="yu"
                                                    style="@error('file_path')
                                                        border: 2px solid red
                                                    @enderror"
                                                    multiple>
                                                @error('file_path')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" {{$data->status == 'published' ? 'checked' : ''}} name = "status"
                                                    id="exampleCheck1">
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


                </div>


            </div>
        </section>



    </div>
@endsection

@section('CustomJs')
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
    {{-- <script>
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'lists link image preview',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        menubar: false,
    });
</script> --}}
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
            .create(document.querySelector('#content'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    'imageUpload'
                ],
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload') }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
