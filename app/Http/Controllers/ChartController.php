<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{


    public function getRepairsDataForComparison($previousPeriod = 'week')
    {
        // Calculate the start and end dates for the last week
        $endDate = Carbon::now()->endOfWeek();
        $startDate = Carbon::now()->startOfWeek()->subWeek();

        // Calculate the start and end dates for the previous week
        $previousEndDate = Carbon::now()->startOfWeek()->subDay();
        $previousStartDate = Carbon::now()->startOfWeek()->subWeeks(2)->subDay();

        // Get the number of completed repairs for the last week
        $currentWeekRepairs = Repair::where('status', 'completed')
            ->whereBetween('endDate', [$startDate, $endDate])
            ->count();

        // Get the number of completed repairs for the previous week
        $previousWeekRepairs = Repair::where('status', 'completed')
            ->whereBetween('endDate', [$previousStartDate, $previousEndDate])
            ->count();

        // Calculate the percentage change
        $percentageChange = 0;
        if ($previousWeekRepairs != 0) {
            $percentageChange = (($currentWeekRepairs - $previousWeekRepairs) / $previousWeekRepairs) * 100;
        }

        // Return data in an array
        return [
            'currentWeekRepairs' => $currentWeekRepairs,
            'previousWeekRepairs' => $previousWeekRepairs,
            'percentageChange' => $percentageChange
        ];
    }



    public function getTotalAmountComparison($previousPeriod = 'month')
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get the start and end dates for the current period
        $currentStartDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
        $currentEndDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

        // Calculate the start and end dates for the previous period
        $previousStartDate = $previousEndDate = null;
        if ($previousPeriod === 'month') {
            $previousStartDate = $currentStartDate->subMonth();
            $previousEndDate = $currentEndDate->subMonth();
        } elseif ($previousPeriod === 'year') {
            $previousStartDate = $currentStartDate->subYear();
            $previousEndDate = $currentEndDate->subYear();
        }

        // Get the total amount for the current period
        $currentTotalAmount = Repair::with('invoices')
            ->whereBetween('endDate', [$currentStartDate, $currentEndDate])
            ->get()
            ->sum(function ($repair) {
                return $repair->invoices->sum('totalAmount');
            });

        // Get the total amount for the previous period
        $previousTotalAmount = Repair::with('invoices')
            ->whereBetween('endDate', [$previousStartDate, $previousEndDate])
            ->get()
            ->sum(function ($repair) {
                return $repair->invoices->sum('totalAmount');
            });

        // Calculate the percentage change
        $percentageChange = 0;
        if ($previousTotalAmount != 0) {
            $percentageChange = (($currentTotalAmount - $previousTotalAmount) / $previousTotalAmount) * 100;
        }

        // Return data in an array
        return [
            'currentTotalAmount' => $currentTotalAmount,
            'previousTotalAmount' => $previousTotalAmount,
            'percentageChange' => $percentageChange
        ];
    }


    public function getMechanicsDataForComparison($previousPeriod = 'month')
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get the start and end dates for the current period
        $currentStartDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
        $currentEndDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

        // Calculate the start and end dates for the previous period
        $previousStartDate = $previousEndDate = null;
        if ($previousPeriod === 'month') {
            $previousStartDate = $currentStartDate->subMonth();
            $previousEndDate = $currentEndDate->subMonth();
        } elseif ($previousPeriod === 'year') {
            $previousStartDate = $currentStartDate->subYear();
            $previousEndDate = $currentEndDate->subYear();
        }

        // Get the number of mechanics for the current period
        $currentMechanicsNum = User::where('role', 'mechanic')
            ->whereBetween('created_at', [$currentStartDate, $currentEndDate])
            ->count();

        // Get the number of mechanics for the previous period
        $previousMechanicsNum = User::where('role', 'mechanic')
            ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->count();

        // Calculate the percentage change
        $percentageChange = 0;
        if ($previousMechanicsNum != 0) {
            $percentageChange = (($currentMechanicsNum - $previousMechanicsNum) / $previousMechanicsNum) * 100;
        }

        // Return data in an array
        return [
            'currentMechanicsNum' => $currentMechanicsNum,
            'previousMechanicsNum' => $previousMechanicsNum,
            'percentageChange' => $percentageChange
        ];
    }


    public function getNewOrdersDataForComparison($previousPeriod = 'month')
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get the start and end dates for the current period
        $currentStartDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
        $currentEndDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

        // Calculate the start and end dates for the previous period
        $previousStartDate = $previousEndDate = null;
        if ($previousPeriod === 'month') {
            $previousStartDate = $currentStartDate->subMonth();
            $previousEndDate = $currentEndDate->subMonth();
        } elseif ($previousPeriod === 'year') {
            $previousStartDate = $currentStartDate->subYear();
            $previousEndDate = $currentEndDate->subYear();
        }

        // Get the number of new orders for the current period
        $currentNewOrdersNum = Repair::where('status', 'pending')
            ->whereBetween('created_at', [$currentStartDate, $currentEndDate])
            ->count();

        // Get the number of new orders for the previous period
        $previousNewOrdersNum = Repair::where('status', 'pending')
            ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->count();

        // Calculate the percentage change
        $percentageChange = 0;
        if ($previousNewOrdersNum != 0) {
            $percentageChange = (($currentNewOrdersNum - $previousNewOrdersNum) / $previousNewOrdersNum) * 100;
        }

        // Return data in an array
        return [
            'currentNewOrdersNum' => $currentNewOrdersNum,
            'previousNewOrdersNum' => $previousNewOrdersNum,
            'percentageChange' => $percentageChange
        ];
    }



    public function getUsersDataForComparison($previousPeriod = 'month')
    {
        // Get the current number of users
        $currentUsersNum = User::count();

        // Calculate the start and end dates for the previous period
        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        // Adjust the dates based on the chosen previous period
        if ($previousPeriod === 'week') {
            $startDate = Carbon::now()->subWeek()->startOfWeek();
            $endDate = Carbon::now()->subWeek()->endOfWeek();
        } elseif ($previousPeriod === 'year') {
            $startDate = Carbon::now()->subYear()->startOfYear();
            $endDate = Carbon::now()->subYear()->endOfYear();
        }
        // dd($startDate, $endDate);
        // Get the number of users for the previous period
        $previousUsersNum = User::whereBetween('created_at', [$startDate, $endDate])->count();


        // Calculate the percentage change
        $percentageChange = 0;
        if ($previousUsersNum != 0) {
            $percentageChange = (($currentUsersNum - $previousUsersNum) / $previousUsersNum) * 100;
        }

        // Return data in an array
        return [
            'currentUsersNum' => $currentUsersNum,
            'previousUsersNum' => $previousUsersNum,
            'percentageChange' => $percentageChange
        ];
    }

    public function showCharts()
    {
        if (Auth::user()->role === 'admin') {
            // Retrieve data for completed repairs count
            $completedRepairsByMonth = DB::table('repairs')
                ->select(DB::raw('YEAR(endDate) AS year, MONTH(endDate) AS month, COUNT(*) AS completed_repairs_count'))
                ->where('status', 'completed')
                ->groupBy(DB::raw('YEAR(endDate), MONTH(endDate)'))
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $labels = [];
            $completedRepairsData = [];
            $revenueData = [];

            // Process completed repairs and revenue data
            foreach ($completedRepairsByMonth as $repair) {
                $labels[] = date('M Y', mktime(0, 0, 0, $repair->month, 1, $repair->year));
                $completedRepairsData[] = $repair->completed_repairs_count;

                // Retrieve and calculate revenue data for the same month
                $revenue = DB::table('repairs')
                    ->join('invoices', 'repairs.id', '=', 'invoices.repair_id')
                    ->where('repairs.status', 'completed')
                    ->whereYear('repairs.endDate', $repair->year)
                    ->whereMonth('repairs.endDate', $repair->month)
                    ->sum('invoices.totalAmount');

                $revenueData[] = $revenue;
            }

            // Prepare chart data
            $chartData = [
                'labels' => $labels,
                'completed_repairs' => $completedRepairsData,
                'revenue' => $revenueData,
            ];

            // Retrieve other data for the view
            $totalCompletedRepairs = DB::table('repairs')->where('status', 'completed')->count();
            $totalAmounts = Repair::with('invoices')->get()->sum(function ($repair) {
                return $repair->invoices->sum('totalAmount');
            });
            $usersNum = User::where('role', 'client')->latest()->count();
            $mechanicsNum = User::where('role', 'mechanic')->latest()->count();
            $totalAmountLastWeek = 0; // Calculate this value as per your requirements
            $totalAmountLastMonth = 0; // Calculate this value as per your requirements
            $totalOrders = DB::table('repairs')->where('status', 'pending')->count();
            $usersComparisonData = $this->getUsersDataForComparison();
            $repairsDataForComparison = $this->getRepairsDataForComparison();
            $totalAmountComparison = $this->getTotalAmountComparison();
            $mechanicsDataForComparison = $this->getMechanicsDataForComparison();
            $newOrdersDataForComparison = $this->getNewOrdersDataForComparison();

            $repairs = Repair::with('mechanic', 'invoices')->get();

            $mechanicsTotalAmount = [];

            foreach ($repairs as $repair) {
                // Get the mechanic's data
                $mechanicData = $repair->mechanic;

                // Get the mechanic's name
                $mechanicName = $mechanicData->name;

                // Get the total amount for this repair
                $totalAmount = $repair->invoices->sum('totalAmount');

                // Add the total amount to the mechanic's data
                if (!isset($mechanicsTotalAmount[$mechanicName])) {
                    $mechanicsTotalAmount[$mechanicName] = $mechanicData;
                    $mechanicsTotalAmount[$mechanicName]->totalEarned = 0;
                }
                $mechanicsTotalAmount[$mechanicName]->totalEarned += $totalAmount;
            }
            $mechanicsEarned = [];

            foreach ($mechanicsTotalAmount as $mechanicName => $mechanicData) {
                $totalEarned = $mechanicData->totalEarned;
                $mechanicsEarned[$mechanicName] = $totalEarned;
            }


            $topThreeMechanics = [];

            // Sort mechanics by total earned amounts in descending order
            arsort($mechanicsEarned);

            // Extract the top three earners
            $topThreeMechanics = array_slice($mechanicsEarned, 0, 3);

            // Extract names and total earned amounts for the top three mechanics
            $topThreeNames = array_keys($topThreeMechanics);
            $topThreeEarned = array_values($topThreeMechanics);

            $topThreeChartData = [
                'mechanics' => $topThreeNames,
                'earned' => $topThreeEarned,
            ];

            return view('admin.dashboard', [
                'data' => $chartData,
                'totalCompletedRepairs' => $totalCompletedRepairs,
                'totalAmount' => $totalAmounts,
                'usersNum' => $usersNum,
                'usersComparisonData' => $usersComparisonData,
                'totalAmountLastWeek' => $totalAmountLastWeek,
                'totalAmountLastMonth' => $totalAmountLastMonth,
                'repairsDataForComparison' => $repairsDataForComparison,
                'mechanicsNum' => $mechanicsNum,
                'totalOrders' => $totalOrders,
                'totalAmountComparison' => $totalAmountComparison,
                'mechanicsDataForComparison' => $mechanicsDataForComparison,
                'newOrdersDataForComparison' => $newOrdersDataForComparison,
                'mechanicsTotalAmount' => $mechanicsTotalAmount,
                'topThreeChartData' => $topThreeChartData,
            ]);
        } else {
            // Retrieve data for regular user
            $currentUser = Repair::with('invoices')->where('user_id', Auth::user()->id)->get();
            $userVehicle = Auth::user()->vehicles;
            $invoiceDetails = [];
        
            if ($userVehicle) {
                foreach ($userVehicle as $vehicle) {
                    $invoiceDetails[] = [
                        'vehicleMake' => $vehicle->make,
                        'vehicleRegistration' => $vehicle->registration,
                    ];
                }
            }
        
            foreach ($currentUser as $user) {
                $invoiceDetails[] = [
                    'status' => $user->status ,
                    'amountToPay' => $user->invoices->sum('totalAmount'),
                ];
            }
        
            // Retrieve invoices associated with the authenticated user
            $userId = Auth::id();
            $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')
                ->whereHas('repair', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->get();
        
            foreach ($invoices as $invoice) {
                $mechanicName = $invoice->repair->mechanic->name;
                $invoiceDetails[] = [
                    'mechanicName' => $mechanicName,
                ];
            }
        
            // Return the view with user data
            return view('admin.dashboard', [
                'invoiceDetails' => $invoiceDetails,
            ]);
        }
        
    }
}
