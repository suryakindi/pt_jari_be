<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Dashboard\DashboardRepository;
class DashboardController extends Controller
{
    private $DashboardRepository;
    public function __construct(DashboardRepository $DashboardRepository)
    {
     $this->DashboardRepository = $DashboardRepository;
    }


    public function countBookBooking(){
     return $this->DashboardRepository->countBookBooking();
    }
    public function CountUser(){
        return $this->DashboardRepository->CountUser();
       }
    

}
