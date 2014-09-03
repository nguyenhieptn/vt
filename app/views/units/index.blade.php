@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="span12">
        <div class="widget">

            <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>{{ trans("gen.unit list")}}</h3>
                    <span class="pull-right"><a class="btn btn-small btn-success" href="javascript:;">{{ trans("gen.add")}}</a></span>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="30px">ID</th>
                            <th>{{ trans("gen.unit name")}}</th>
                            <th class="td-actions" width="80px"> {{ trans("gen.tools")}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($units as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td class="td-actions">
                                <a class="btn btn-small btn-success" href="javascript:;"><i class="btn-icon-only icon-edit"> </i></a>
                                <a class="btn btn-danger btn-small" href="{{ route('units.destroy',array($u->id)) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?"><i class="btn-icon-only icon-remove"> </i></a>
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
@section('footer')
@parent
<!-- extend foot here -->
@stop