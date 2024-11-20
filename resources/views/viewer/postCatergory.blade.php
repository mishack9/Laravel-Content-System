@extends('viewer.layout')



@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Posts_Catergory</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('viewer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Posts_Catergory</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="row">


                 @if(!$post_catergory)
                    <div class="container alert alert-warning mb-4">
                        No Post_Catergory Available At The Moment.......
                    </div>
                @else 
                @foreach ($post_catergory as $post)
                <div class="col-md-6 mb-2">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-bullhorn"></i>
                                <span class="text-primary">Post_Catergory</span>
                            </h3>
                            <div class="card-tools">
                                <p><span class="text-success">Catergory : </span> {{$post->catergory->name}} </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-success" style="height: 250px">
                              
                                <h5><span class="text-info">Post_title: </span> {{ucfirst($post->title)}}</h5>
                               <p>{!! Str::words($post->content, 15) !!} <a href="{{route('viewer.readmore',$post->id)}}" class="text-primary"> Readmore </a> </p>
                                <div class="mt-3">
                                    <h6>Posted_by : <span class="text-info"> {{ucfirst($post->user->name)}}</span></h6>
                                </div>
                                <div class="text-right mt-2 text-success">
                                    {{$post->created_at->format('F j, Y')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               @endif 

                </div>


            </div>
        </section>

    </div>
@endsection
