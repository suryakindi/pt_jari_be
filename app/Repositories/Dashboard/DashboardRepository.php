<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Repository;

interface DashboardRepository extends Repository{

    public function countBookBooking();
    public function CountUser();
    // Write something awesome :)
}
