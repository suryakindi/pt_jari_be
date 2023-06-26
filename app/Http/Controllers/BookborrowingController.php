<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Bookborrowing\BookborrowingRepository;
class BookborrowingController extends Controller
{
    private $bookborrowing;
    public function __construct(BookborrowingRepository $bookborrowing)
    {
        $this->bookborrowing = $bookborrowing;
    }
    public function index(){
       return $this->bookborrowing->ShowBookBorrowing();
    }
    
    public function create(Request $request){
        return $this->bookborrowing->createBook($request);
    }
    public function listuser(){
        return $this->bookborrowing->listuser(); 
    }

    public function listbook(){
        return $this->bookborrowing->listbook();
    }
}
