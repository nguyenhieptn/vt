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
                    {{ Form::model($user,['route' => ['users.update',$user->id], 'method'=>'patch','class'=>'form-horizontal']); }}
                    <fieldset>
                        <br />
                        <label class="control-label" for="first_name">{{ trans("gen.firstname") }}</label>
                        <div class="controls">
                            <input class="span6" id="first_name" name="first_name" value="{{ $user->first_name }}" type="text">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="lastname">{{ trans("gen.lastname") }}</label>
                        <div class="controls">
                            <input class="span6" id="last_name" name="last_name" value="{{ $user->last_name }}" type="text">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="username">{{ trans("gen.user name") }}</label>
                        <div class="controls">
                            <input class="span6" id="username" name="username" value="{{ $user->username }}" type="text">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="email">{{ trans("gen.email") }}</label>
                        <div class="controls">
                            <input class="span6" id="email" name="email" value="{{ $user->email }}" type="text">
                        </div> <!-- /controls -->
                        <br />
                        <label class="control-label" for="password">{{ trans("gen.password") }}</label>
                        <div class="controls">
                            <input class="span6" id="password" name="password" type="password">
                        </div> <!-- /controls -->
                        <br />

                        <label class="control-label">Checkboxes</label>
                        <div class="controls">
                            @foreach($units as $u)
                            <label class="checkbox list-group">
                                <input type="checkbox" name="units[]" value="{{ $u->id }}" <?php if(in_array($u->id,$user->unitList)) echo "checked='checked'"; ?> />{{ $u->name }}
                            </label>
                            @endforeach
                            <?php //exit;?>
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
