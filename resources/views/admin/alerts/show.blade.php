@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.alerts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.alerts.fields.date')</th>
                            <td field-key='date'>{{ $alert->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.alerts.fields.score')</th>
                            <td field-key='score'>{{ $alert->score }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.alerts.fields.type')</th>
                            <td field-key='type'>{{ $alert->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.alerts.fields.controller')</th>
                            <td field-key='controller'>{{ $alert->controller->name ?? '' }}</td>
<td field-key='status'>{{ Form::checkbox("status", 1, isset($alert->controller) && $alert->controller->status == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.alerts.fields.created-by')</th>
                            <td field-key='created_by'>{{ $alert->created_by->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.alerts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
