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
                    <form action="#" class="form-horizontal">
                    <fieldset>
                        <br />
                        <label class="control-label" for="title">{{ trans("gen.document title") }}</label>
                        <div class="controls">
                            <input class="span6" id="title" name="title" value="{{ $document->title }}" type="text" disabled="disabled">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="description">{{ trans("gen.document description") }}</label>
                        <div class="controls">
                            {{ Form::textarea('description',$document->description,['class'=>'span6',"disabled"=>"disabled"]) }}
                        </div> <!-- /controls -->
                        <br />



                @if (count(json_decode($document->files)))
                        <br />
                        <label class="control-label">{{ trans("gen.files") }}</label>
                        <div class="controls">

                            @foreach(json_decode($document->files) as $f)
                            <a href="{{ URL::asset('uploads/'.$f) }}" >{{ $f }}</a>
                            <br />
                            @endforeach

                        </div><!-- /controls -->
                @endif
                    </fieldset>
                </form>
                </div>
                <!-- /widget-content -->
            </div>

        </div> <!-- /widget -->
    </div> <!-- /span12 -->
</div> <!-- /row -->


@stop
