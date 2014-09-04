@extends('layouts.layout')
@section('head')
@parent
{{ HTML::style("css/pages/units.css")}}
@stop
@section('content')
<div class="row">
    <div class="span12">
        <div class="widget">

            <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>{{ trans("gen.edit unit") }}</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    @if($errors->has())
                    @foreach ($errors->all() as $error)
                    <ul>
                        <li>{{ $error }}</li>
                    </ul>
                    @endforeach
                    @endif
                    {{ Form::model($unit, ['route' => ['units.update', $unit->id], 'method' => 'patch','class'=>'form-horizontal']) }}
                    <fieldset>
                        <br />
                        <label class="control-label" for="name">{{ trans("gen.unit name") }}</label>
                        <div class="controls">
                            <input class="span6" id="name" name="name" value="{{ $unit->name }}" type="text">
                        </div> <!-- /controls -->

                        <button type="submit" class="btn btn-success">{{ trans("gen.save") }}</button>
                        {{ Form::token() }}
                    </fieldset>
                    {{ Form::close() }}



                </div>
                <!-- /widget-content -->
            </div>

        </div> <!-- /widget -->
    </div> <!-- /span12 -->
</div> <!-- /row -->


@stop
