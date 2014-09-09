<!DOCTYPE html>
<html lang="en">
<head>
    @section("head")
    <meta charset="utf-8">
    <title>{{ trans("gen.title") }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- page style -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-responsive.min.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600') }}
    {{ HTML::style('css/font-awesome.css') }}
    {{ HTML::style('css/style.css') }}
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    {{ HTML::script('http://html5shim.googlecode.com/svn/trunk/html5.js') }}
    <![endif]-->
    @show
</head>
<body>
<div class="navbar navbar-fixed-top">
    @include("layouts.navbar")
</div> <!-- /navbar -->

<div class="subnavbar">
    @include("layouts.subnavbar")
</div> <!-- /subnavbar -->

<div class="main">

    <div class="main-inner">

        <div class="container">
            @if($errors->has())
            <div class="row">
                <div class="span12">
                <div class="alert alert-block">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                    @endforeach
                </div>
                </div>
            </div>
            @endif


            @yield("content")

        </div> <!-- /container -->

    </div> <!-- /main-inner -->

</div> <!-- /main -->

<div class="footer">

    <div class="footer-inner">

        <div class="container">

            <div class="row">

                <div class="span12">
                    &copy; 2013 <a href="http://www.thainguyenpost.vn/">{{ trans("gen.company title") }}</a>.
                </div> <!-- /span12 -->

            </div> <!-- /row -->

        </div> <!-- /container -->

    </div> <!-- /footer-inner -->

</div> <!-- /footer -->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@section("footer")
    {{ HTML::script('js/jquery-1.7.2.min.js') }}
    {{ HTML::script('js/bootstrap.js') }}
    {{ HTML::script('js/base.js') }}
@show
</body>

</html>
