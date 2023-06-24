<?php

namespace App\Repositories\Bookborrowing;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Bookborrowing;
use App\Http\Controllers\BaseController;
use DB;

class BookborrowingRepositoryImplement extends Eloquent implements BookborrowingRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Bookborrowing $model)
    {
        $this->model = $model;
    }
    public function ShowBookBorrowing(){
        $borrowing = $this->model::with('user', 'book')->paginate(5);
      
        if($borrowing == NULL ){
            return BaseController::error(NULL, 'Data Notfound', '404');
        }
    
        return BaseController::success($borrowing, 'Success', 200);
    }
    public function SearchBook(){
        $name = request()->query('name');
        $namebook = request()->query('book_name');
        $query = $this->model::with('user', 'book')->whereHas('user', function($query) use ($name){
            $query->where('name','LIKE', '%'.$name.'%');
        })->orwhereHas('book', function($query) use ($namebook){
            $query->where('name','LIKE', '%'.$namebook.'%');
        })->get();
        
        return BaseController::success($query, 'Sucess', 200);
    }

    public function createBook($request){
        try {
            DB::beginTransaction();
            $booking = $this->model::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'borrow_date' => $request->date,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        return BaseController::success($booking ,'Success', 200);
    }
    
    // Write something awesome :)
}
