<?php

namespace App\Repositories\Bookborrowing;

use LaravelEasyRepository\Repository;

interface BookborrowingRepository extends Repository{

    public function ShowBookBorrowing();    
    public function createBook($request);
    public function listuser();
    public function listbook();
    // Write something awesome :)
}
