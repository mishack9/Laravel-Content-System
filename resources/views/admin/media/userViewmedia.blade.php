@extends('admin.layout')



@section('CustomCss')
@endsection




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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard / Post</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">


                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-tools text-right">
                                    <a href="{{ route('admin.viewMediaPost') }}" class="btn btn-info">Go_Back</a>
                                </div>
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn"></i>
                                    <span class="text-warning">{{ $data->user->name }}'s</span>
                                </h3>
                            </div>


                            <p class="ml-4">
                                Tags :
                                @foreach ($data->tag as $tag)
                                    <span class="text-info">{{ $tag->name }}</span>
                                @endforeach
                            </p>

                            {{--     <div class="row">
                            <strong>Media File : </strong>
                                    @foreach ($data->media as $media)
                            <div class="col-md-4">
                                <div class="media">
                                    
                                          <img src="{{asset('storage/'.$media->file_path)}}" alt="Image_Media">
                                    
                                </div>
                            </div>
                            @endforeach
                           </div> --}}

                            <div class="card-body">
                                <div class="callout callout-success">
                                    @if ($data->catergory->name)
                                        <p><span class="text-primary">Catergory :</span> {{ $data->catergory->name }}</p>
                                    @endif
                                    <p><em><span class="text-success">Post_title : </span> {{ $data->title }}</em></p>
                                    <p><em><span class="text-success">Post_Content : </span> {!! $data->content !!}</em>
                                    </p>

                                    <div class="text-right text-warning">
                                        {{ $data->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    @foreach ($data->media as $media)
                        <div class="col-md-6 mb-2">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-bullhorn"></i>
                                        <span class="text-warning">{{ $data->user->name }}</span>
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <div class="callout callout-success">
                                        <h5 class="text-success"><span style="color: rgb(99, 58, 43)">Catergory :
                                            </span>{{ $data->catergory->name }}</h5>

                                        <div class="media"
                                            style="align-items: center; justify-content:center; display:flex">

                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="Image_Media"
                                                style="width: 250px; height:233px;object-fit:cover">

                                        </div>

                                        <div class="ml-3">
                                            <div class="container text-center">
                                                <p><span class="text-success">Content : </span> {!! $data->content !!} </p>
                                            </div>
                                        </div>



                                        <div class="text-right text-warning mt-2">
                                            {{ $data->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>


            </div>
        </section>

    </div>
@endsection




@section('CustomJs')
@endsection
