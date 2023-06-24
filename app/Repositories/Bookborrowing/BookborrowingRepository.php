<?php

namespace App\Repositories\Bookborrowing;

use LaravelEasyRepository\Repository;

interface BookborrowingRepository extends Repository{

    public function ShowBookBorrowing();    
    public function SearchBook();
    public function createBook($request);
    // Write something awesome :)
}
