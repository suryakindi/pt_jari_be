<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Book;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
class BookRepositoryImplement extends Eloquent implements BookRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }
    public function showbook(){
        $book = $this->model::paginate(5);
        return BaseController::success($book, 'Success');
        
    }
    public function getBookname(){
        $name = request()->query('namebook');
        
        $book = $this->model::where('name', 'LIKE', '%'.$name.'%')->get();
        
        try {
           if($book->count() == 0){
            return BaseController::error(NULL, 'Data Notfound', 400);
           } 
        } catch (\Throwable $th) {
            throw $th;
        }
        return BaseController::success($book, 'Success', 200);
    
    }
    public function createBook($request){
        try {
            //code...
            $book = $this->model::create([
                'name'=>$request->name,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        $name = $request->name;
        return BaseController::success($name, 'Success Menambahkan Buku', 200);
    }
    public function updateBook($request, $id){
        try {
            $book = $this->model::find($id);
            if($book == NULL){
                return BaseController::error(NULL, 'Data Notfound', 404);
            }
            $this->model::where('id', $id)->update([
                'name'=>$request->name,
            ]);
          
        } catch (\Throwable $th) {
            throw $th;
        }
        $name = $request->name;
        return BaseController::success($name, 'Update Sukses', 200);
    }

    public function deleteBook($id){
        try {
            $book = $this->model::find($id);
            if($book == NULL){
                return BaseController::error(NULL, 'Data Notfound', 404);
            }
            $this->model::where('id', $id)->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
        return BaseController::success($id, 'Delete Success', 200);
    }
    // Write something awesome :)
}
