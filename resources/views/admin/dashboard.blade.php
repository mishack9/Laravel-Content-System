@extends('admin.layout')



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
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>




        



      

    </div>
</section>



{{-- @if(Auth::user()->role === 'user')

<section class="content">
    <div class="container-fluid">

        <div class="row">


            @foreach ($post as $post)
            <div class="col-md-6 mb-2">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn"></i>
                            <span class="text-primary">Post</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-success" style="height: 250px">
                            <h5><span class="text-info">Post_title: </span> {{ucfirst($post->title)}}</h5>
                            <p><span class="text-info">Content: </span> {!! Str::words($post->content, 25) !!}</p>
                            <div class="">
                                <h6>Posted_by : <span class="text-info"> {{ucfirst($post->user->name)}}</span></h6>
                            </div>
                            <div class="text-right mb-2 text-success">
                                {{$post->created_at->format('F j, Y')}}
                            </div>
                            @if (Auth::user()->role === 'user' && $post->approval_status === 'pending')
                                <div class="text-left">
                                    <form action="{{route('reviewer.review',$post->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-outline-dark">Mark as review</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>


    </div>
</section>

@endif --}}
  

</div>

@endsection