@extends('layouts.layout')
@section('content')
<div class="row">

    <div class="span12">
        @if($errors->has())
        @foreach ($errors->all() as $error)
        <div class="alert">s
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Warning! {{ $error }}</strong>
        </div>
        @endforeach
        @endif


        <div class="widget">

            <div class="widget-header">
                <i class="icon-th-large"></i>
                <h3>Choose Your Plan</h3>
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