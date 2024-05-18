@extends('admin.layouts.home')
@section('content')
<div class="main-content">

    <div class="page-content">
        @if (Auth::user()->role==="admin")
            
       
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>


                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-5">
                <div class="col-xl-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1 text-center">
                                <h4 class="text-truncate font-size-25 mb-2" style="color:#D8AE7E;">Total Amounts</h4>
                                    <h4 class="mb-2">$ {{$totalAmount }}</h4>
                                 
                                </div>

                            </div>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1 text-center">
                                <h4 class="text-truncate font-size-25 mb-2" style="color:#D8AE7E;">New Orders</h4>
                                    <h4 class="mb-2">
                                        {{$totalOrders}}
                                    </h4>
                                    
                                </div>
                             
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1 text-center">
                                    <h4 class="text-truncate font-size-25 mb-2" style="color:#D8AE7E;">Users</h4>
                                    <h4 class="mb-2">
                                        {{ $usersNum }}
                                    </h4>
                                </div>
                               
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1 text-center">
                                <h4 class="text-truncate font-size-25 mb-2" style="color:#D8AE7E;">Mechanics</h4>
                                    <h4 class="mb-2">{{$mechanicsNum}}</h4>
                                    
                                </div>
                                
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div>
                </div><!-- end col -->
            <!-- end row -->

            <div class="col-7" >
                <div class="row">
 
                <!-- end col -->
                <div class="col-xl-12">
                   <div class="card">
                        <div class="card-body pb-0">
                            <div class="float-end d-none d-md-inline-block">
                               
                            </div>
                            <h4 class="card-title mb-4" style="color:#D8AE7E;">Revenue</h4>

                            <div class="text-center pt-3">
                                <div class="row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="d-inline-flex">
                                            <h5 class="me-2">{{$totalCompletedRepairs}}</h5>
                                            <div class="text-success font-size-12">
                                            </div>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Completed Repairs</p>
                                    </div><!-- end col -->
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <div class="d-inline-flex">
                                            <h5 class="me-2">$ {{$totalAmountLastWeek}}</h5>
                                            <div class="text-success font-size-12">
                                                <i class="mdi mdi-menu-up font-size-14"> </i>{{$repairsDataForComparison['percentageChange']}} %
                                            </div>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Last Week</p>
                                    </div><!-- end col -->
                                    <div class="col-sm-4">
                                        <div class="d-inline-flex">
                                            <h5 class="me-2">$ {{$totalAmountLastMonth}}</h5>
                                            <div class="text-success font-size-12">
                                                <i class="mdi mdi-menu-up font-size-14"> </i>{{$repairsDataForComparison['percentageChange']}} %
                                            </div>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Last Month</p>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div>
                        </div>
                        <div class="card-body py-0 px-2">
                            <div id="column_line_chart" style="width: 80%; margin: auto;"></div>
                            <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
                            <script>
                                var chartData = @json($data);
                                var options = {
                                    series: [
                                        {
                                            name: "Completed Repairs (Column)",
                                            type: "column",
                                            data: chartData.completed_repairs
                                        },
                                        {
                                            name: "Revenue (Line)",
                                            type: "line",
                                            data: chartData.revenue
                                        }
                                    ],
                                    chart: { height: 350, toolbar: { show: false } },
                                    stroke: { width: [0, 2.3], curve: "smooth" },
                                    plotOptions: { bar: { horizontal: false, columnWidth: "34%" } },
                                    dataLabels: { enabled: false },
                                    markers: {
                                        size: [0, 3.5],
                                        colors: ["#6fd088"],
                                        strokeWidth: 2,
                                        strokeColors: "#6fd088",
                                        hover: { size: 4 },
                                    },
                                    legend: { show: true },
                                    yaxis: {
                                        labels: {
                                            formatter: function (e) {
                                                // Check if the value is greater than or equal to 1000
                                                if (Math.abs(e) >= 1000) {
                                                    // Divide the value by 1000 and round to two decimal places
                                                    var val = (Math.abs(e) / 1000).toFixed(1);
                                                    // Return the formatted value with "k" appended
                                                    return val + "k";
                                                }
                                                // Return the original value if it's less than 1000
                                                return e;
                                            },
                                        },
                                    },
                                    colors: ["#0f9cf3", "#6fd088"],
                                    labels: chartData.labels
                                };
                            
                                var chart = new ApexCharts(
                                    document.querySelector("#column_line_chart"),
                                    options
                                );
                                chart.render();
                            </script>
                            
                            
                            
                            
                        </div>
                        
                    </div><!-- end card -->
                </div>
                            </div>
                <!-- end col -->
            </div>
            </div>
            <!-- end row -->


           
            <!-- end row -->
        </div>

        @elseif(Auth::user()->role==="client")
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{Auth::user()->name}}</a></li>
                                <li class="breadcrumb-item active">{{Auth::user()->role}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
           
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Amount To Pay</p>
                                    <h4 class="mb-2 font-size-16">
                                    
                                       
                                            @foreach ($invoiceDetails as $detail)
                                                @if (isset($detail['amountToPay']))
                                                    <h4 class="font-size-14 mb-2">{{ $detail['amountToPay'] }}</h4>
                                                @endif
                                            @endforeach    
                                        </h4>
                                        
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Status</p>
                                    <h4 class="mb-2 font-size-16">
                                        @foreach ($invoiceDetails as $detail)
                                            @if (isset($detail['status']))
                                                <h4 class="font-size-14 mb-2">{{ $detail['status'] }}</h4>
                                            @endif
                                        @endforeach     
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    @foreach ($invoiceDetails as $detail)
                                        @if (isset($detail['status']))
                                            @switch($detail['status'])
                                                @case('completed')
                                                    <span class="avatar-title  text-success rounded-3" style="background-color:#4F6F52">
                                                        <i class="ri-check-line font-size-24"></i>  
                                                    </span>
                                                    @break
                                                @case('pending')
                                                    <span class="avatar-title bg-light text-warning rounded-3">
                                                        <i class="ri-time-line font-size-24"></i>  
                                                    </span>
                                                    @break
                                                @case('in_progress')
                                                    <span class="avatar-title bg-light text-primary rounded-3">
                                                        <i class="ri-loader-line font-size-24"></i>  
                                                    </span>
                                                    @break
                                                @default
                                                    <span class="avatar-title bg-light text-danger rounded-3">
                                                        <i class="ri-close-line font-size-24"></i>  
                                                    </span>
                                            @endswitch
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                                                                      
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Vehicle  </p>
                                    @foreach ($invoiceDetails as $detail)
                                        @if (isset($detail['vehicleMake']) && isset($detail['vehicleRegistration']))
                                            <h4 class="font-size-14 mb-2">{{ $detail['vehicleMake'] }} / {{ $detail['vehicleRegistration'] }}</h4>
                                        @endif
                                    @endforeach

                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-car-line font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Mechanic</p>
                                    @foreach ($invoiceDetails as $detail)
                                        @if (isset($detail['mechanicName']))
                                            <h4 class="font-size-14 mb-2">{{ $detail['mechanicName'] }}</h4>
                                        @endif
                                    @endforeach
                                
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title  text-success rounded-3" style="background-color:#4F6F52">
                                        <i class="ri-user-3-line font-size-24"></i>  

                                    </span>
                                </div>
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        
            <!-- Invoice Cards -->
            
            <!-- End Invoice Cards -->
        </div>
        @else
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{Auth::user()->name}}</a></li>
                                <li class="breadcrumb-item active">{{Auth::user()->role}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Gained</p>
                                    <h4 class="mb-2 font-size-16">
                                       $ {{ $totalGained }}
                                    </h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Repairs Status</p>
                                    <h4 class="mb-2 font-size-16">
                                        @php
                                        $allCompleted = true;
                                        $allPending = true;
                                        $allInProgress = true;
                                    @endphp
                                    @foreach($repairsStatus as $repairStatus)
                                        <p>{{ $repairStatus['repair_id'] }}: {{ $repairStatus['status'] }}</p>
                                        @if($repairStatus['status'] !== 'completed')
                                            @php
                                                $allCompleted = false;
                                            @endphp
                                        @endif
                                        @if($repairStatus['status'] !== 'pending')
                                            @php
                                                $allPending = false;
                                            @endphp
                                        @endif
                                        @if($repairStatus['status'] !== 'in_progress')
                                            @php
                                                $allInProgress = false;
                                            @endphp
                                        @endif
                                    @endforeach
                                    </h4>
                                </div>
                                <div class="avatar-sm">

                                   
                                    @if($allCompleted)
                            <span class="avatar-title  text-success rounded-3" style="background-color:#4F6F52">
                                <i class="ri-check-line font-size-24"></i>  
                            </span>
                            @elseif($allPending)
                            <span class="avatar-title bg-light text-warning rounded-3">
                                <i class="ri-time-line font-size-24"></i>  
                            </span>
                            @elseif($allInProgress)
                            <span class="avatar-title bg-light text-primary rounded-3">
                                <i class="ri-loader-line font-size-24"></i>  
                            </span>
                            @endif
                                </div>
                            </div>                                                                  
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                
              
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Users worked with me</p>
                                    @foreach($usersWorkedWith as $user)
                                        <h4 class="font-size-14 mb-2">{{ $user['name'] }} - {{ $user['email'] }}</h4>
                                    @endforeach
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title  text-success rounded-3" style="background-color:#4F6F52">
                                        <i class="ri-user-3-line font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
        @endif
        
    </div>
    <!-- End Page-content -->
   

    
</div>
<footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >

<div class="text-center p-3" style="background-color:#e4dcc7; display:flex;align-items:center;justify-content:center;">
      
   <a class="text-body" href="https://mdbootstrap.com/"> © 2024 Garagiste.com  | Jihad Bourbab</a>
</div>

</footer>
@endsection
