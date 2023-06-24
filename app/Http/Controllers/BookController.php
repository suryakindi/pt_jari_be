<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Book\BookRepository;
class BookController extends Controller
{
    private $BookRepository;
    public function __construct(BookRepository $BookRepository)
    {
        $this->BookRepository = $BookRepository;
    }
    public function index(){
        return $this->BookRepository->showbook();
    }
    public function searchbook(){
        return $this->BookRepository->getBookname();
    }
    public function create(Request $request){
        return $this->BookRepository->createBook($request);
    }
    public function update(Request $request, $id){
        return $this->BookRepository->updateBook($request, $id);
    }
    public function delete($id){
        return $this->BookRepository->deleteBook($id);
    }
}
