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

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">reda</a></li>
                                <li class="breadcrumb-item active">admin</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Amounts</p>
                                    <h4 class="mb-2">$ {{$totalAmount }}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2">
                                        <i class="ri-arrow-right-up-line me-1 align-middle">
                                        </i>{{$totalAmountComparison['percentageChange']}}%</span>from previous period</p>
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
                                    <p class="text-truncate font-size-14 mb-2">New Orders</p>
                                    <h4 class="mb-2">
                                        {{$totalOrders}}
                                    </h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2">
                                        <i class="ri-arrow-right-up-line me-1 align-middle"></i>
                                        {{$newOrdersDataForComparison['percentageChange']}} %</span>from previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>  

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
                                    <p class="text-truncate font-size-14 mb-2">Users</p>
                                    <h4 class="mb-2">
                                        {{ $usersNum }}
                                    </h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>{{$usersComparisonData['percentageChange']}} %</span>from previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>  
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
                                    <p class="text-truncate font-size-14 mb-2">Mechanics</p>
                                    <h4 class="mb-2">{{$mechanicsNum}}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2">
                                        <i class="ri-arrow-right-up-line me-1 align-middle">
                                            </i>{{$mechanicsDataForComparison['percentageChange']}} %</span>from previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>  
                                    </span>
                                </div>
                            </div>                                              
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="float-end d-none d-md-inline-block">
                               
                            </div>
                            <h4 class="card-title mb-4">Completed Repairs</h4>

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
                            {{-- <div id="area_chart" class="apex-charts" dir="ltr"></div> --}}
                            <div id="areaChart" style="width: 80%; margin: auto;">
                                {{-- <canvas id="areaChart"></canvas> --}}
                            </div>
                            <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
                            <script>
                                // Define common color options
                                var commonColors = ['#0f9cf3', '#6fd088', '#ffbb44'];
                            
                                // Define common options for all charts
                                var commonOptions = {
                                    chart: {
                                        toolbar: {
                                            show: false
                                        },
                                        height: 350
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    grid: {
                                        show: true,
                                        borderColor: '#90A4AE',
                                        strokeDashArray: 0,
                                        position: 'back',
                                        xaxis: {
                                            lines: {
                                                show: true
                                            }
                                        },
                                        yaxis: {
                                            lines: {
                                                show: true
                                            }
                                        },
                                        row: {
                                            colors: undefined,
                                            opacity: 0.8
                                        },
                                        column: {
                                            colors: undefined,
                                            opacity: 0.8
                                        },
                                        padding: {
                                            top: 10,
                                            right: 0,
                                            bottom: 10,
                                            left: 10
                                        }
                                    },
                                    legend: {
                                        show: false
                                    }
                                };
                            
                                // Define options for the area chart
                                var areaOptions = {
                                    series: [{
                                        name: 'Completed Repairs',
                                        data: {!! json_encode($data['completed_repairs']) !!}
                                    }],
                                    colors: [commonColors[0]],
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    xaxis: {
                                        categories: {!! json_encode($data['labels']) !!}
                                    }
                                };
                            
                                // Create area chart
                                var areaChart = new ApexCharts(document.querySelector("#areaChart"), Object.assign({}, commonOptions, areaOptions));
                                areaChart.render();
                            </script>
                            

                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-6">
                   <div class="card">
                        <div class="card-body pb-0">
                            <div class="float-end d-none d-md-inline-block">
                               
                            </div>
                            <h4 class="card-title mb-4">Revenue</h4>

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
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>

                            <h4 class="card-title mb-4">Latest Transactions</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                            <th style="width: 120px;">Profit </th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>

                                        @foreach($mechanicsTotalAmount as $mechanic)
                                        <tr>
                                            <td><h6 class="mb-0">{{ $mechanic->name }}</h6></td>
                                            <td>{{ $mechanic->role }}</td>
                                            <td>
                                                <div class="font-size-13"><i class="ri-checkbox-blank-circle-fill font-size-10 text-{{ $mechanic->totalEarned > 0 ? 'success' : 'danger' }} align-middle me-2"></i>{{ $mechanic->totalEarned > 0 ? 'Active' : 'Inactive' }}</div>
                                            </td>
                                            <td>{{ $mechanic->email }}</td>
                                            <td>{{ $mechanic->created_at }}</td>
                                            <td>
                                                {{-- Calculate total amount for mechanic's repairs --}}
                                                @php
                                                    $totalAmount = $mechanic->totalEarned ?? 0;
                                                @endphp
                                                ${{ $totalAmount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    



                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <h4 class="card-title mb-4">Top Three Mechanics</h4>
                            
                           
                            <!-- end row -->

                            <div class="mt-4">
                                {{-- <div id="mechanics_monthly_revenue_chart"></div> --}}
                                <canvas id="topThreeChart" width="400" height="350"></canvas>

                            </div>
                            
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                                var topThreeData = @json($topThreeChartData);
                                var mechanics = topThreeData.mechanics;
                                console.log(mechanics);

                                var earned = topThreeData.earned;

                               
                            
                                var ctx = document.getElementById('topThreeChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: mechanics,
                                        datasets: [{
                                            label: 'Total Earned',
                                            data: earned,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                            
                            
                                                        
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">reda</a></li>
                                <li class="breadcrumb-item active">admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Amount To Pay</p>
                                    <h4 class="mb-2 font-size-16">$ {{$amountToPay }}</h4>
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
                                    <h4 class="mb-2 font-size-16">{{$status}}</h4>
                                </div>
                                <div class="avatar-sm">
                                    @if($status === 'completed')
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="ri-check-line font-size-24"></i>  
                                        </span>
                                    @elseif($status === 'pending')
                                        <span class="avatar-title bg-light text-warning rounded-3">
                                            <i class="ri-time-line font-size-24"></i>  
                                        </span>
                                    @elseif($status === 'in_progress')
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-loader-line font-size-24"></i>  
                                        </span>
                                    @else
                                        <span class="avatar-title bg-light text-danger rounded-3">
                                            <i class="ri-close-line font-size-24"></i>  
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
                                    <p class="text-truncate font-size-14 mb-2">Vehicle  </p>
                                    @foreach ($invoiceDetails as $details)
                                        <h4 class="font-size-14 mb-2">{{ $details['vehicleMake'] }} / {{ $details['vehicleRegistration'] }}</h4>
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
                                    @foreach ($invoiceDetails as $details)
                                        <h4 class="font-size-14 mb-2">{{ $details['mechanicName'] }}</h4>
                                    @endforeach
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
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
        
        
       @endif  
    </div>
    <!-- End Page-content -->
   
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © elklie.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by reda-elklie
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div>
@endsection