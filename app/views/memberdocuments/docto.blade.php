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
            {{ Form::open(array('action' => array('MemberDocuments@documentTo'), 'method' => 'get')) }}
            <input  type="text" name="search" placeholder="Search" value="{{ Input::get('search') }}"/>
            <input  type="text" class="form-control datepicker" name="from"  value="{{ Input::get('from') }}" placeholder="{{ trans("gen.from") }}"/>
            <input  type="text" class="form-control datepicker" name="to"  value="{{ Input::get('to') }}" placeholder="{{ trans("gen.to") }}"/>
            <input type="submit" value="{{ trans("gen.filter") }}" />
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
                    <h3>{{ trans("gen.document list")}}</h3>

                    <span class="pull-right"><a class="btn btn-small btn-success" href="{{ URL::route('documents.create')}}">{{ trans("gen.add")}}</a></span>

                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30px">Date</th>
                            <th>{{ trans("gen.document name")}}</th>
                            <th>{{ trans("gen.document from")}}</th>
                            <th class="td-actions" width="100px"> {{ trans("gen.tools")}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($documents as $d)
                        <tr>
                            <td>{{ $d->created_at }}</td>
                            <td>
                                <a href="{{ URL::to("document/$d->id") }}" >{{ $d->title }}</a>
                            </td>
                            <td>{{ $d->fromunit }}</td>
                            <td class="td-actions">
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
</script>
@stop