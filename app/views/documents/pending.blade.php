@extends('layouts.layout')
@section('head')
@parent
{{ HTML::style("css/datepicker.css")}}
@stop
@section('content')
<!-- filtering row -->
<div class="row">
    <div class="span12">
        <div class="widget">
            {{ Form::open(array('action' => array('DocumentsController@documentPending'), 'method' => 'get','id' => 'submitpending')) }}
            <input  type="text" name="search" placeholder="Search" value="{{ Input::get('search') }}"/>
            <input  type="text" class="form-control datepicker" name="from"  value="{{ Input::get('from') }}" placeholder="{{ trans("gen.from") }}"/>
            <input  type="text" class="form-control datepicker" name="to"  value="{{ Input::get('to') }}" placeholder="{{ trans("gen.to") }}"/>
            <input type="submit" id="submitpublish" value="{{ trans("gen.filter") }}" />
            {{ Form::hidden("publish_id",'0',array('id' => 'publish_id')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- /filter -->
<div class="row">
    <div class="span12">
        <div class="widget">
            <div class="widget widget-table action-table">

                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>{{ trans("gen.document pending list")}}</h3>

                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30px">Date</th>
                            <th>{{ trans("gen.document name")}}</th>
                            <th class="td-actions" width="100px"> {{ trans("gen.tools")}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $d)
                        <tr>
                            <td>{{ $d->created_at }}</td>
                            <td>
                                @if( in_array(Sentry::getUser()->id,(array)json_decode($d->read,true)) )
                                <a href="{{ URL::to("document/$d->id") }}" >{{ $d->title }}</a>
                                @else
                                <b style="font-size: 15px"><a href="{{ URL::to("document/$d->id") }}" >{{ $d->title }}</a></b>
                                @endif
                            </td>

                            <td class="td-actions">
                                <a id="{{$d->id}}" class="btn btn-small btn-success publish" href="#"><i class="btn-icon-only icon-ok-sign"> </i></a>

                                {{ Form::open(array('route' => array('documents.destroy', $d->id), 'method' => 'delete')) }}
                                <button type="submit" class="btn btn-danger">x</button>

                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /widget-content -->

            </div>


        </div> <!-- /widget -->
        {{ $documents->links() }}
    </div> <!-- /span12 -->
</div> <!-- /row -->
@stop
@section('footer')
@parent
{{ HTML::script('js/bootstrap-datepicker.js') }}
<script type="text/javascript">
    $('.datepicker').datepicker({
    });
    $('.publish').click(function(){
        var id=$(this).attr('id');
        $('#publish_id').val(id);
        $('#submitpublish').trigger( "click" );
    })
</script>
@stop