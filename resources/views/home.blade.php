@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
       <div class="panel panel-default">
           <div class="panel-heading">Recently added consumptions</div>

           <div class="panel-body table-responsive">
               <table class="table table-bordered table-striped ajaxTable">
                   <thead>
                   <tr>

                       <th> liters</th>
                       <th> cost</th>
                       <th>&nbsp;</th>
                   </tr>
                   </thead>
                   @foreach($consumptions as $consumption)
                       <tr>

                           <td>{{ $consumption->liters }} </td>
                           <td>{{ $consumption->cost }} </td>
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
                       </tr>
                   @endforeach
               </table>
           </div>
       </div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="panel panel-default">
      <div class="panel-heading">Recently added alerts</div>

      <div class="panel-body table-responsive">
          <table class="table table-bordered table-striped ajaxTable">
              <thead>
              <tr>

                  <th> score</th>
                  <th> type</th>
                  <th>&nbsp;</th>
              </tr>
              </thead>
              @foreach($alerts as $alert)
                  <tr>

                      <td>{{ $alert->score }} </td>
                      <td>{{ $alert->id }} </td>
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
                  </tr>
              @endforeach
          </table>
      </div>
  </div>
</div>

</div>


    <div class="row">
        <div class="col-md-10">
            <h2 style="margin-top: 0;">{{ $reportTitle }}</h2>

            <form action="" method="get">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="date_filter" id="date_filter"/>
                </div>
                <div class="col-md-8">
                    <input type="submit" name="filter_submit" class="btn btn-success" value="Filter" />
                </div>
            </div>
            </form>

            <canvas id="myChart"></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script>
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: '{{ $chartType }}',
                    data: {
                        labels: [
                            @foreach ($results as $group => $result)
                                "{{ $group }}",
                            @endforeach
                        ],

                        datasets: [{
                            label: '{{ $reportLabel }}',
                            data: [
                                @foreach ($results as $group => $result)
                                    {!! $result !!},
                                @endforeach
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [],
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>
@stop

@section('javascript')
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

    <script type="text/javascript">
        $(function () {
            let dateInterval = getQueryParameter('date_filter');
            let start = moment().startOf('isoWeek');
            let end = moment().endOf('isoWeek');
            if (dateInterval) {
                dateInterval = dateInterval.split(' - ');
                start = dateInterval[0];
                end = dateInterval[1];
            }
            $('#date_filter').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "alwaysShowCalendars": true,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
                }
            });
        });
        function getQueryParameter(name) {
            const url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
    </script>

@endsection
