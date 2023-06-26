<?php

namespace App\Repositories\Bookborrowing;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Bookborrowing;
use App\Http\Controllers\BaseController;
use DB;
use App\Models\User;
use App\Models\Book;
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
        $name = request()->query('name');
        $namebook = request()->query('name_book');
        if($name){
            $query = $this->model::with('user', 'book')->whereHas('user', function($query) use ($name){
                $query->where('name','LIKE', '%'.$name.'%');
            })->get();
            return BaseController::success($query, 'Success', 200);
        }

        if($namebook){
        $query = $this->model::with('user', 'book')->whereHas('book', function($query) use ($namebook){
            $query->where('name','LIKE', '%'.$namebook.'%');
        })->get();
        return BaseController::success($query, 'Success', 200);
        }
        
        $query = $this->model::with('user', 'book')->paginate(5);
        if($query == NULL ){
            return BaseController::error(NULL, 'Data Notfound', '404');
        }
        return BaseController::success($query, 'Success', 200);
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

    public function listuser(){
        $listuser = User::all();
        $result = [];
        foreach($listuser as $item) {
            $data["id"] = $item->id;
            $data["name"] = $item->name;
            $result[] = $data;            
        }

        return BaseController::success($result, 'Success', 200);
    }
    
    public function listbook(){
        $listbook = Book::all();
        $result = [];
        foreach($listbook as $item){
            $data['id'] = $item->id;
            $data['name_book'] = $item->name;
            $result[] = $data;
        }
        return BaseController::success($result, 'Success', 200);
    }

    
    // Write something awesome :)
}
