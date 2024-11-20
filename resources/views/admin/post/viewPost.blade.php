@extends('admin.layout')


@section('CustomCss')
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="dist/css/adminlte.min2167.css?v=3.2.0">
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
                            <li class="breadcrumb-item active">Dashboard/View_Posts</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Posts</h3>
                        <div class="card-tools text-right">
                          {{--  @if (Auth::user()->role === 'admin')
                           <a href="{{ route('admin.viewEditorPost') }}" class="btn btn-primary">View Editor Posts</a>
                           @else --}}
                           <a href="{{ route('admin.createPost') }}" class="btn btn-primary">Add_Posts</a>
                           
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Post_Title</th>
                                    <th>Post_Content</th>
                                    <th>Status</th>
                                    <th>Author</th>
                                    <th>Created_Date</th>
                                    <th>View</th>
                                    <th>edith</th>
                                    <th>Delete</th>
                                    @if (Auth::user()->role === 'editor')
                                        <th>Submit_For_Approval</th>
                                    @endif
                                   @if (Auth::user()->role === 'admin')
                                   
                                    <th>Approval</th>
                                    <th>Rejected</th>
                                       
                                   @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $post)
                                    <tr>
                                        <td>{{ $post['id'] }}</td>
                                        <td>{{ $post['title'] }}</td>
                                        <td>{!! Str::limit($post['content'], 20) !!}</td>
                                        <td>{{ $post['status'] }}</td>
                                        <td>{{ $post->user['name'] }}</td>
                                        <td>{{ $post->created_at->format('F j, Y') }}</td>
                                        <td><a href="{{ route('admin.viewUserPost', $post['id']) }}" class="btn btn-info"><i
                                                    class="fas fa-eye"></i></a></td>
                                        <td><a href="{{ route('admin.edithPost', $post['id']) }}" class="btn btn-success"><i
                                                    class="fas fa-pen"></i></a></td>
                                        <td><a href="{{ route('admin.deletePost', $post['id']) }}"
                                                onclick="confirmation(event)" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></a></td>
                                        @if(Auth::user()->role === 'editor')
                                        @if ($post->approval_status === 'pending' && Auth::user()->can('update', $post))
                                          <td>  <form action="{{ route('posts.submitApproval', $post->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary btn-sm">Submit for
                                                    Approval</button>
                                            </form>
                                        </td>
                                        @else
                                             <td><h2 class="text-success"><em>{{ucfirst($post->approval_status)}}</em></h2></td>
                                        @endif
                                        @endif
                                       @if (Auth::user()->role === 'admin')
                                       @if ($post->approval_status === 'pending')
                                       <td><a href="{{ route('admin.approvePost', $post['id']) }}"
                                        class="btn btn-secondary"><i class="fa fa-check-circle"
                                            aria-hidden="true"></i></a></td>
                                <td><a href="{{ route('admin.rejectPost', $post['id']) }}"
                                        onclick="confirmation(event)" class="btn btn-warning"><i
                                            class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                       @endif
                                           
                                       @endif
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Post_Title</th>
                                    <th>Post_Content</th>
                                    <th>Status</th>
                                    <th>Author</th>
                                    <th>Created_Date</th>
                                    <th>View</th>
                                    <th>Edith</th>
                                    <th>Delete</th>
                                    @if (Auth::user()->role === 'editor')
                                        <th>Submit_For_Approval</th>
                                    @endif
                                   @if (Auth::user()->role === 'admin')
                                   
                                    <th>Approval</th>
                                    <th>Rejected</th>
                                       
                                   @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>


            </div>
        </section>

    </div>
@endsection


@section('CustomJs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function confirmation(ev) {

            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            swal({

                    title: "Are You Sure You Want To Reject This Posts ?",
                    text: "This Data Will Only be Vissible On Your Dashboard !!!",
                    icon: "warning",
                    buttons: true,
                    warningMode: true,

                })

                .then((willCancel) => {

                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }

                });

        }
    </script>

    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="dist/js/demo.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
