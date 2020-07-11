<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
          rel="stylesheet">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{URL::to('vendor/bootstrap/css/bootstrap.min.css')}}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{URL::to('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/templatemo-stand-blog.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/owl.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style type="text/css">
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{URL::to('dashboard')}}"><h2>{{ config('app.name') }}<em>.</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{URL::to('dashboard')}}">Home
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('blog') ? 'active' : '' }}">
                        <a class="nav-link" href="{{URL::to('blog')}}">Blog Entries</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{URL::to('logout')}}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-content">
                        <h4>Recent Posts</h4>
                        <h2>Our Recent Blog Entries</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row" id="blog_list">
                        @if(count($blogs) > 0)
                            @foreach($blogs as $blog)
                                <div class="col-lg-12">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{$blog->image}}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <a href="javascript:void(0)"><h4>{{$blog->title}}</h4></a>
                                            <ul class="post-info">
                                                <li>
                                                    <a href="javascript:void(0)">{{isset($blog->creator->name) ? $blog->creator->name:''}}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">{{date('d M Y', strtotime($blog->created_at))}}</a>
                                                </li>
                                            </ul>
                                            <p>{!! $blog->description !!}</p>
                                            @php
                                                $categories_names = \Illuminate\Support\Facades\DB::selectOne("SELECT GROUP_CONCAT(c.name SEPARATOR ' | ') as categories_name from blog_to_categories btc, blogs b, categories c WHERE btc.blog_id = b.id and btc.category_id = c.id and b.id = $blog->id");
                                            @endphp
                                            @if(isset($categories_names->categories_name))
                                                <div class="post-options">
                                                    <div class="row">
                                                        <div class="col-12">

                                                            <ul class="post-tags">
                                                                <li><i class="fa fa-tags"></i></li>
                                                                <li>
                                                                    <a href="javascript:void(0)">{{$categories_names->categories_name}}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                <div class="main-button">
                                    <a href="javascript:void(0)" onclick="create_blog();">POST NEW BLOG</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5>Date Wise Filter</h5><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sidebar-item search">
                                <input type="date" name="q" class="searchText" id="start_date"
                                       placeholder="Start Date..."
                                       autocomplete="off">
                                <br>
                                <br>

                                <input type="date" name="q" class="searchText" id="end_date" placeholder="End Date..."
                                       autocomplete="off">
                                <br>
                                <br>
                                <a class="btn btn-primary" onclick="get_blogs();" href="javascript:void(0)">Search</a>
                            </div>
                        </div>
                        @if(count($categories))
                            <div class="col-lg-12">
                                <div class="sidebar-item categories">
                                    <div class="sidebar-heading">
                                        <h2>Categories</h2>
                                    </div>
                                    <div class="content">
                                        <ul>
                                            @foreach($categories as $category)
                                                <li><a href="#">- {{$category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="basicModal" style="z-index: 9999999;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"  id="modal_body">

        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="social-icons">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Linkedin</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>Copyright 2020 | Design: <a rel="nofollow" href="#" target="_parent">{{ config('app.name') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
@if(Session::has('success'))
    <script>
        Swal.fire(
            'Success',
            '{{ Session::get('success') }}',
            'success'
        )
    </script>
@elseif(Session::has('errors'))
    <script>
        Swal.fire(
            'Oops!',
            '@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach',
            'error'
        )
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function () {
        $('#basicModal').modal('show');
    });
    function get_blogs() {
        let loader = '<div style="margin-left: 240px;" class="loader"></div>';
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();
        if (start_date == '') {
            Swal.fire(
                'Oops!',
                'Please select start date',
                'error'
            )
        } else if (end_date == '') {
            Swal.fire(
                'Oops!',
                'Please select end date',
                'error'
            )
        } else {
            $('#blog_list').html(loader);
            $.get('{{ url('get_blogs') }}', {start_date: start_date, end_date: end_date}, function (data) {
                if (data != 'empty') {
                    $('#blog_list').html(data);
                } else {
                    $('#blog_list').html("No Blogs available for selected dates");
                }
            });
        }
    }

    function create_blog() {
        $('#basicModal').modal('show');
        $.get('{{ url('create_blog') }}', {test: 1}, function (data) {
            $('#modal_body').html(data);
        });
    }
</script>
<!-- Bootstrap core JavaScript -->
<script src="{{URL::to('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Additional Scripts -->
<script src="{{URL::to('assets/js/custom.js')}}"></script>
<script src="{{URL::to('assets/js/owl.js')}}"></script>
<script src="{{URL::to('assets/js/slick.js')}}"></script>
<script src="{{URL::to('assets/js/isotope.js')}}"></script>
<script src="{{URL::to('assets/js/accordions.js')}}"></script>


</body>
</html>