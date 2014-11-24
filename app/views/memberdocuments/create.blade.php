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
                    <h3>{{ trans("gen.new document") }}</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    {{ Form::open(array('url'=>'memberdocuments','class'=>'form-horizontal','files'=>true)) }}
                    <fieldset>
                        <br />
                        <label class="control-label" for="title">{{ trans("gen.document title") }}</label>
                        <div class="controls">
                            <input class="span6" id="title" name="title" value="{{ Input::old('title') }}" type="text">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="description">{{ trans("gen.document description") }}</label>
                        <div class="controls">
                            {{ Form::textarea('description',Input::old('description'),['class'=>'span6']) }}
                        </div> <!-- /controls -->
                        <br />

                        <label for="group" class="control-label">{{ trans("gen.document from") }}</label>
                        <div class="controls">
						
                            {{ Form::select('from_unit_id',$unitMembers,'member',['class'=>'control']) }}
                        </div><!-- /controls -->
                        <br />
                        <label class="control-label">{{ trans("gen.document to") }}</label>
                        <div class="controls">
						@foreach($unitMembers as $key=>$value )
						  <!-- <label class="checkbox list-group">
						 {{ Form::checkbox('to_units_id[]',$key, false) }}
                                {{ $value }}
                            </label>
						 @endforeach
						  </controls -->
                          @foreach($units as $id=>$name)
                            <label class="checkbox list-group">
                                {{ Form::checkbox('to_units_id[]',$id, false) }}
                                {{ $name }}
                            </label>
                            @endforeach
                       
						</div>
                        <br />
                        <label class="control-label">{{ trans("gen.files") }}</label>
                        <div class="controls">
                            {{ Form::file('files[]', array('multiple'=>true)); }} <br />
                            {{ Form::file('files[]', array('multiple'=>true)); }} <br />
                            {{ Form::file('files[]', array('multiple'=>true)); }} <br />
                        </div><!-- /controls -->



                        <button type="submit" class="btn btn-success">{{ trans("gen.save") }}</button>
                    </fieldset>
                    {{ Form::hidden("user_id",Sentry::getUser()->id) }}
                    {{ Form::hidden("activated",'1') }}
                    {{ Form::hidden("state",'1') }}
                    {{ Form::close() }}
                </div>
                <!-- /widget-content -->
            </div>

        </div> <!-- /widget -->
    </div> <!-- /span12 -->
</div> <!-- /row -->


@stop
