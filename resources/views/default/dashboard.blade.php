@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">          
            
            <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Daily Sales</h3>
                      <a href="{{ url('/') }}/reports/sales">View Report</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">P{{ number_format($thismonthtotalsales, 2, ".", ",")}}</span>
                        <span>Sales Over Time</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i>{{ number_format($salespercent['thismonthtotalsalespercent'], 2, ".", ",")}}%
                        </span>
                        <span class="text-muted">Since last month</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                      <canvas id="sales-chart-monthly" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> This month
                      </span>

                      <span>
                        <i class="fas fa-square text-gray"></i> Last month
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->

            </div><!-- /.Ccol -->    
            <div class="col-lg-6">
                <div class="card">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Monthly Sales</h3>
                      <a href="{{ url('/') }}/reports/sales">View Report</a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <p class="d-flex flex-column">
                        <span class="text-bold text-lg">P{{ number_format($thisyeartotalsales, 2, ".", ",")}}</span>
                        <span>Sales Over Time</span>
                      </p>
                      <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> {{ number_format($salespercent['thisyeartotalsalespercent'], 2, ".", ",")}}%
                        </span>
                        <span class="text-muted">Since last month</span>
                      </p>
                    </div>
                    <!-- /.d-flex -->

                    <div class="position-relative mb-4">
                      <canvas id="sales-chart-daily" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                      <span class="mr-2">
                        <i class="fas fa-square text-primary"></i> This year
                      </span>

                      <span>
                        <i class="fas fa-square text-gray"></i> Last year
                      </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->

            </div><!-- /.Ccol -->     
        </div><!-- /.row -->        
      </div><!-- /.container-fluid -->      
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
@push('styles')  
  
@endpush
@push('scripts')
<script src="{{ url('/') }}/plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
  $(function () {
    'use strict'

    $('.treeview-dashboard').addClass('active');    
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index';
  var intersect = true;
  var $salesChartMonthly = $('#sales-chart-monthly');
  // eslint-disable-next-line no-unused-vars
  var salesChartMonthly = new Chart($salesChartMonthly, {
    type: 'bar',
    data: {
      labels: [
        @php
            $period = '';
            /* This Month Data */    
                $salesthismonth = '';
                $salesthismonthdata = json_decode(json_encode($thismonth['data']), true);                
                foreach($thismonth['dates'] as $date){
                  $period .= "'".$date->format('M d')."',";
                  $i = array_search($date->format('Y-m-d'), array_column($salesthismonthdata, 'new_date'));

                    if(isset($i)){
                      if($i === '0' || $i === 0 ||
                        $i === 0.0 || $i) {
                          $salesthismonth .= $salesthismonthdata[$i]['amount'].',';
                      } else {
                        $salesthismonth .= '0,';
                      }
                    }                    
                }

            /* Last Month Data */
            $saleslastmonth = '';
                $saleslastmonthdata = json_decode(json_encode($lastmonth['data']), true);                
                foreach($lastmonth['dates'] as $date){                  
                  $i = array_search($date->format('Y-m-d'), array_column($saleslastmonthdata, 'new_date'));
                  
                    if(isset($i)){
                      if($i === '0' || $i === 0 ||
                        $i === 0.0 || $i) {
                          $saleslastmonth .= $saleslastmonthdata[$i]['amount'].',';
                      } else {
                        $saleslastmonth .= '0,';
                      }
                    }                    
                }


            @endphp
            {!! $period !!}           
      ],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [{{ $salesthismonth }}]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [{{ $saleslastmonth }}]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000000000 && value <= 999999999999) {
                value /= 1000000000
                value += 'B'
              }else if (value >= 1000000 && value <= 999999999) {
                value /= 1000000
                value += 'M'
              }else if (value >= 1000 && value <= 999999) {
                value /= 1000
                value += 'K'
              }else{
                value += ''
              }
              return '₱' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  });

  var $salesChartDaily = $('#sales-chart-daily');
  // eslint-disable-next-line no-unused-vars
  var salesChartDaily = new Chart($salesChartDaily, {
    type: 'bar',
    data: {
      labels: [        
        @php
            $period = '';
            /* This Year Data */    
                $salesthisyear = '';
                $salesthisyeardata = json_decode(json_encode($thisyear['data']), true);                
                foreach($thisyear['dates'] as $date){
                  $period .= "'".$date->format('M')."',";
                  $i = array_search($date->format('Y-m'), array_column($salesthisyeardata, 'new_date'));

                    if(isset($i)){
                      if($i === '0' || $i === 0 ||
                        $i === 0.0 || $i) {
                          $salesthisyear .= $salesthisyeardata[$i]['amount'].',';
                      } else {
                        $salesthisyear .= '0,';
                      }
                    }                    
                }

            /* Last Year Data */
            $saleslastyear = '';
                $saleslastyeardata = json_decode(json_encode($lastyear['data']), true);                
                foreach($lastyear['dates'] as $date){                  
                  $i = array_search($date->format('Y-m'), array_column($saleslastyeardata, 'new_date'));
                  
                    if(isset($i)){
                      if($i === '0' || $i === 0 ||
                        $i === 0.0 || $i) {
                          $saleslastyear .= $saleslastyeardata[$i]['amount'].',';
                      } else {
                        $saleslastyear .= '0,';
                      }
                    }                    
                }

                
            @endphp
            {!! $period !!} 
      ],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [{{$salesthisyear}}]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [{{$saleslastyear}}]
        }
      ]
    },
    options: {
      /*scaleLabel: function(label) {
        return value.toLocaleString("en-US",{style:"currency", currency:"USD"});
      }, */
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000000000 && value <= 999999999999) {
                value /= 1000000000
                value += 'B'
              }else if (value >= 1000000 && value <= 999999999) {
                value /= 1000000
                value += 'M'
              }else if (value >= 1000 && value <= 999999) {
                value /= 1000
                value += 'K'
              }else{
                value += ''
              }

              return '₱' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  });

});

</script>
@endpush

        

