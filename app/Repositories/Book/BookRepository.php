<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Repository;
use Illuminate\Http\Request;
interface BookRepository extends Repository{
    
    public function showbook();
    public function getBookname();
    public function createBook(Request $request);
    public function updateBook(Request $request, $id);
    public function deleteBook($id);
   
}
