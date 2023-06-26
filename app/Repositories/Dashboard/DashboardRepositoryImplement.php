<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use App\Models\Bookborrowing;
use DB;
class DashboardRepositoryImplement extends Eloquent implements DashboardRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */


    public function countBookBooking(){
    if(request()->query('start_month') && request()->query('end_month')){
        $start_month = request()->query('start_month');
        $end_month = request()->query('end_month');
        $startmonthFormatted = Carbon::now()->month($start_month)->startOfMonth();
        $endmonthFormatted = Carbon::now()->month($end_month)->endOfMonth();
        $namestartmonth = $startmonthFormatted->format('M');
        $nameendmonth = $endmonthFormatted->format('M');
        $booking = Bookborrowing::whereBetween('borrow_date', [$startmonthFormatted, $endmonthFormatted])->count();
        $data = [
            "month"=>[
                $namestartmonth.'-'.$nameendmonth,
            ],
            "book_total"=>[
                $booking,
            ],
        ];
    }
    else
    {
        $month = Carbon::now();
        $booking = Bookborrowing::whereMonth('borrow_date', $month)->count();
       
        $data = $booking;
        
    }
        return BaseController::success($data, 'Total Booking This Month', 200);
    }

    public function CountUser(){
        $userhighbooking = Bookborrowing::select('user_id', DB::raw('count(*) as total_borrowings'))
        ->groupBy('user_id')
        ->orderByDesc('total_borrowings')
        ->limit(2)
        ->get();
        $data = $userhighbooking;
        return BaseController::success($data, 'User Have High Booking', 200);
    }

    

    // Write something awesome :)
}
