@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.control.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.control.fields.name')</th>
                            <td field-key='name'>{{ $control->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.control.fields.status')</th>
                            <td field-key='status'>{{ Form::checkbox("status", 1, $control->status == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.control.fields.created-by')</th>
                            <td field-key='created_by'>{{ $control->created_by->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#alerts" aria-controls="alerts" role="tab" data-toggle="tab">Alerts</a></li>
<li role="presentation" class=""><a href="#consumption" aria-controls="consumption" role="tab" data-toggle="tab">Consumption</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="alerts">
<table class="table table-bordered table-striped {{ count($alerts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.alerts.fields.date')</th>
                        <th>@lang('global.alerts.fields.score')</th>
                        <th>@lang('global.alerts.fields.type')</th>
                        <th>@lang('global.alerts.fields.controller')</th>
                        <th>@lang('global.alerts.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($alerts) > 0)
            @foreach ($alerts as $alert)
                <tr data-entry-id="{{ $alert->id }}">
                    <td field-key='date'>{{ $alert->date }}</td>
                                <td field-key='score'>{{ $alert->score }}</td>
                                <td field-key='type'>{{ $alert->type }}</td>
                                <td field-key='controller'>{{ $alert->controller->name ?? '' }}</td>
                                <td field-key='created_by'>{{ $alert->created_by->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alerts.restore', $alert->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alerts.perma_del', $alert->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('alert_view')
                                    <a href="{{ route('admin.alerts.show',[$alert->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('alert_edit')
                                    <a href="{{ route('admin.alerts.edit',[$alert->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('alert_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.alerts.destroy', $alert->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="consumption">
<table class="table table-bordered table-striped {{ count($consumptions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.consumption.fields.liters')</th>
                        <th>@lang('global.consumption.fields.cost')</th>
                        <th>@lang('global.consumption.fields.date')</th>
                        <th>@lang('global.consumption.fields.control')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($consumptions) > 0)
            @foreach ($consumptions as $consumption)
                <tr data-entry-id="{{ $consumption->id }}">
                    <td field-key='liters'>{{ $consumption->liters }}</td>
                                <td field-key='cost'>{{ $consumption->cost }}</td>
                                <td field-key='date'>{{ $consumption->date }}</td>
                                <td field-key='control'>{{ $consumption->control->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.consumptions.restore', $consumption->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.consumptions.perma_del', $consumption->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('consumption_view')
                                    <a href="{{ route('admin.consumptions.show',[$consumption->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('consumption_edit')
                                    <a href="{{ route('admin.consumptions.edit',[$consumption->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('consumption_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.consumptions.destroy', $consumption->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.controls.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


