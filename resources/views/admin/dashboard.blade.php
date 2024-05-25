

@extends('admin.layouts.home')
@section('content')

<style>

    .clientcontainer{
        width:100%;
        height:fit-content;
        display: flex;
    
        align-items:center;
        justify-content:center;

    }
    .clientcontainer div{
        height:50%;
        width:100%;
        display: flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        gap:50px;
        padding:20px;

    }

    .card img{
        height:120px;
        width:120px;
    }

    .card{
        width:400px;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        border-radius:5px;
        
    }

    .card-body{
        background-color:#436850;
        display: flex;
        flex-direction:column;
        gap:2px;
        width: fit-content;
        padding:10px;
        border-radius:5px;

    }

     p{
        color:white;
        font-size:19px;
    }



</style>
<div class="main-content">

    <div class="page-content">
    @if (Auth::user()->role==="admin")
            
       
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                       
                        <h4> {{__('Dashboard')}}</h4>
                
                    </div>
                </div>
            </div>
        
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
                        <h4 class="mb-sm-0">{{__('Dashboard')}}</h4>
                        
                    </div>
                </div>
            </div>
            <div class="clientcontainer">
<div>
            <div class="card" style="width:40rem;">
  <img src="https://t3.ftcdn.net/jpg/01/71/13/24/360_F_171132449_uK0OO5XHrjjaqx5JUbJOIoCC3GZP84Mt.jpg" height="100px;" width="100px;"class="card-img-top" alt="...">
  <h2 >{{__('Vehicles')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
    
  <ul>
      @foreach ($invoiceDetails as $detail)
        @if (isset($detail['vehicleMake']) && isset($detail['vehicleRegistration']))
          <li><p><span style="color:yellow;">Make:</span>  {{ $detail['vehicleMake'] }} / <span style="color:yellow;">Registration:</span>  {{ $detail['vehicleRegistration'] }}</p></li>
        @endif
      @endforeach
    </ul>
  </div>    
</div>

<div class="card" style="width:40rem;">
  <img src="https://cdn-icons-png.flaticon.com/512/1995/1995470.png" class="card-img-top" alt="...">
  <h2>{{__('Mechanics')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
    
  <ul>
      @foreach ($invoiceDetails as $detail)
        @if (isset($detail['mechanicName']))
          <li><p><span style="color:yellow;">{{ $detail['mechanicName'] }}</p></span></li>
        @endif
      @endforeach
    </ul>
    
  </div>
</div>
</div>

<div>
<div class="card" style="width:40rem;">
  <img src="https://thumbs.dreamstime.com/b/invoice-icon-vector-isolated-white-background-invoice-transparent-sign-invoice-icon-vector-isolated-white-background-invoice-134067056.jpg" class="card-img-top" alt="...">
  <h2 >{{__('Invoices')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
  <ul>
  <?php
    $invoicecount = 0;
    foreach ($invoiceDetails as $detail){
        if (isset($detail['amountToPay'])){
            if($detail['amountToPay']>0){
                $invoicecount++;
                echo "<li><p><span style=color:yellow;>Invoice </span> {$invoicecount}: {$detail['amountToPay']} $</p></li>";
            }
          
        }
    }
    ?>
    </ul>
  </div>
</div>

<div class="card" style="width:40rem;">
  <img src="https://cdn.vectorstock.com/i/500p/14/65/growth-progress-arrow-vector-49461465.jpg" class="card-img-top" alt="...">
  <h2 >{{__('Status')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
    <ul>
  <?php
    $invoicecount = 0;
    foreach ($invoiceDetails as $detail){
        if (isset($detail['status'])){
       
                $invoicecount++;
                echo "<li><p><span style=color:yellow;>Vehicle</span>  {$invoicecount}: {$detail['status']} </p></li>";
            }
          
        
    }
    ?>
    </ul>
    
  </div>
</div>

</div>
                    
            </div>
        
            
        </div>
        @else
        <div class="container-fluid">
            <!-- start page title -->
                                                                                                        <div class="row">
                                                                                                            <div class="col-12">
                                                                                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                                                                                    <h4 class="mb-sm-0">{{__('Dashboard')}}</h4>
                                                                                                                    <div class="page-title-right">
                                                                                                                        <ol class="breadcrumb m-0">
                                                                                                                    
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                  <div class="clientcontainer">
        <div>
            <div class="card" style="width:40rem;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi05J4tIegi0k0qRhEojuMc2qq26_TkvKksHWw-qE-wg&s" height="100px;" width="100px;"class="card-img-top" alt="...">
                <h2 >{{__('Total Earned')}}</h2> 
                <div class="card-body" style="height:300px;overflow:hidden;color:white;">

                            <p><span style="color:yellow;">Ttoal Earned :</span> $ {{ $totalGained }} </p>

                </div>
</div>
            <div class="card" style="width:40rem;">
  <img src="https://cdn-icons-png.flaticon.com/512/1995/1995470.png" class="card-img-top" alt="...">
  <h2>{{__('My Repairs')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
    
  <ul>

      @foreach ($repairsStatus  as $repair)

          <li><p><span style="color:yellow;">Repair  {{ $repair['repair_id'] }} </span>: {{ $repair['status'] }}</p> </li>
    
      
      @endforeach
    </ul>
    
  </div>
 </div>
 </div>

 <div>
 <div class="card" style="width:40rem;">
  <img src="https://thumbs.dreamstime.com/b/invoice-icon-vector-isolated-white-background-invoice-transparent-sign-invoice-icon-vector-isolated-white-background-invoice-134067056.jpg" class="card-img-top" alt="...">
  <h2 >{{__('My Clients')}}</h2>
  <div class="card-body" style="height:300px;overflow:hidden;color:white;">
  <ul>
  @foreach($usersWorkedWith as $user)
                                        <li><p><span style="color:yellow;">{{ $user['name'] }} </span>: {{ $user['email'] }} </p> </li>
 @endforeach
    </ul>
  </div>
 </div>


            
        @endif
        
    </div>
</div>
    <!-- End Page-content -->
   

    
 </div>
 <footer class="bg-body-tertiary text-center mt-30" style="bottom:0;position:fixed;left:150px;right:0;" >

 <div class="text-center p-3" style="background-color:#e4dcc7; display:flex;align-items:center;justify-content:center;">
      
   <a class="text-body" href="https://mdbootstrap.com/"> © 2024 Garagiste.com  | Jihad Bourbab</a>
 </div>

</footer>
@endsection
