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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
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
                                    <a href="{{ route('admin.viewPost') }}" class="btn btn-info">Go_Back</a>
                                </div>
                                <h3 class="card-title">
                                    <i class="fas fa-bullhorn"></i>
                                    <span class="text-warning">{{ $data->user->name }}'s</span>
                                </h3>
                            </div>

                            
                            <p class="ml-4 mt-3">
                              Tags :
                              @foreach ($data->tag as $tag)
                              <span class="text-info">{{$tag->name}}</span>
                              @endforeach
                            </p>

                            <div class="card-body">
                                <div class="callout callout-success">
                                    @if ($data->catergory->name)
                                        <p><span class="text-primary">Catergory :</span> {{ $data->catergory->name }}</p>
                                    @endif
                                    <h3><span class="text-primary">Post_title : </span> <b> {{ $data->title }}</b></h3>
                                   <p> <h4><span class="text-success">Post_Content : </span></h4>  {!! $data->content !!} </p>

                                    <div class="text-right text-success">
                                       {{ $data->created_at->diffForHumans() }}  
                                    </div>
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
@endsection
