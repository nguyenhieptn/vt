@extends('layouts.layout')
@section('head')
@parent
@stop
@section('content')
<div class="row">
    <div class="span12">
        <div class="widget">

            <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>{{ trans("gen.new unit") }}</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    {{ Form::open(array('url'=>'users','class'=>'form-horizontal')) }}
                    <fieldset>
                    <br />
                    <label class="control-label" for="first_name">{{ trans("gen.firstname") }}</label>
                    <div class="controls">
                        <input class="span6" id="first_name" name="first_name" value="{{ Input::old('firstname') }}" type="text">
                    </div> <!-- /controls -->
                    <br />
                    <label class="control-label" for="lastname">{{ trans("gen.lastname") }}</label>
                    <div class="controls">
                        <input class="span6" id="last_name" name="last_name" value="{{ Input::old('last_name') }}" type="text">
                    </div> <!-- /controls -->
                    <br />
                    <label class="control-label" for="username">{{ trans("gen.user name") }}</label>
                    <div class="controls">
                        <input class="span6" id="username" name="username" value="{{ Input::old('username') }}" type="text">
                    </div> <!-- /controls -->
                    <br />
                    <label class="control-label" for="email">{{ trans("gen.email") }}</label>
                    <div class="controls">
                        <input class="span6" id="email" name="email" value="{{ Input::old('email') }}" type="text">
                    </div> <!-- /controls -->
                    <br />
                    <label class="control-label" for="password">{{ trans("gen.password") }}</label>
                    <div class="controls">
                        <input class="span6" id="password" name="password" type="password">
                    </div> <!-- /controls -->
                    <br />

                    <label class="control-label">{{ trans("gen.units") }}</label>

                    <div class="controls">
                        @foreach($units as $u)
                        <label class="checkbox list-group">
                            {{ Form::checkbox('units[]',$u->id, false) }}
                            {{ $u->name }}
                        </label>
                        @endforeach
                    </div><!-- /controls -->

                    <label for="group" class="control-label">{{ trans("gen.user group") }}</label>
                    <div class="controls">

                        {{ Form::select('group',['member'=>'Member','admin'=>'Admin'],'member',['class'=>'control']) }}
                    </div><!-- /controls -->

                    <button type="submit" class="btn btn-success">{{ trans("gen.save") }}</button>
                    </fieldset>
                    {{ Form::hidden("activated",'1') }}
                    {{ Form::close() }}
                </div>
                <!-- /widget-content -->
            </div>

        </div> <!-- /widget -->
    </div> <!-- /span12 -->
</div> <!-- /row -->


@stop
