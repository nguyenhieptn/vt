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
                    <h3>{{ trans("gen.unit list")}}</h3>
                    <span class="pull-right"><a class="btn btn-small btn-success" href="{{ URL::route('units.create')}}">{{ trans("gen.add")}}</a></span>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30px">ID</th>
                            <th>{{ trans("gen.unit name")}}</th>

                            <th>{{ trans("gen.unit type")}}</th>
                            <th class="td-actions" width="100px"> {{ trans("gen.tools")}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->unit_type }}</td>
                            <td class="td-actions">
                                <a class="btn btn-small btn-success" href="{{ URL::to('units/' . $u->id. '/edit') }}"><i class="btn-icon-only icon-edit"> </i></a>
                                {{ Form::open(array('route' => array('units.destroy', $u->id), 'method' => 'delete')) }}
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
    </div> <!-- /span12 -->
</div> <!-- /row -->


@stop
