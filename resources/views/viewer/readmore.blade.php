@extends('viewer.layout')



@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('viewer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="row">



                    <div class="col-md-12 mb-2">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn"></i>
                                    <span class="text-primary">Post</span>
                                </h3>
                                <div class="card-tools">
                                    <a href="{{ route('viewer.dashboard') }}" class="btn btn-primary">Go_Back</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="callout callout-success">
                                    <h5><span class="text-info">Post_title: </span> {{ ucfirst($data->title) }}</h5>
                                    <span class="text-info">Content: </span> {{ $data->content }}
                                    <div class="mt-2">
                                        <h6>Posted_by : <span class="text-info"> {{ ucfirst($data->user->name) }}</span>
                                        </h6>
                                    </div>
                                    <div class="text-right mt-2 text-success">
                                        {{ $data->created_at->format('F j, Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($data->media as $media)
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn"></i>
                                    <span class="text-warning">{{ $media->user->name }}</span>
                                </h3>
                            </div>
                         
                                <div class="card-body">
                                    <div class="callout callout-success shadow-lg">
                                        <div class="media" style="align-items:center; justify-content:center">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="" style="height:150px; width:250px; object-fit:cover">
                                        </div>
                                        <div class="text-right mt-2 text-success">
                                            {{ $data->created_at->format('F j, Y') }}
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
