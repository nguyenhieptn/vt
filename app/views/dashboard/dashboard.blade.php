@extends('layouts.layout')
@section('content')
<div class="row">

    <div class="span12">
        <div class="widget">

            <div class="widget-header">
                <i class="icon-th-large"></i>
                <h3>{{ trans("dashboard") }}</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                Dashboard here

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->


</div> <!-- /row -->
@stop
@section('footer')
@parent
<!-- extend foot here -->
@stop