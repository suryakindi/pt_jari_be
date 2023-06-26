<?php

namespace App\Repositories\Book;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Book;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class BookRepositoryImplement extends Eloquent implements BookRepository
{

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
    public function showbook()
    {
        $bookName = request()->input('namebook');

        $query = $this->model::query();

        if ($bookName) {
            $query->where('name', 'LIKE', '%' . $bookName . '%');
        }

        $query->orderBy('created_at', 'desc'); // Order by newest first

        $books = $query->paginate(5);

        return BaseController::success($books, 'Success', 200);
    }
    public function getBookById($id)
    {

        $book = $this->model::where('id', $id)->get();

        if ($book == NULL) {
            return BaseController::error(NULL, 'Data Notfound', 400);
        }

        return BaseController::success($book, 'Success', 200);
    }
    public function createBook($request)
    {
        try {
            //code...
            $book = $this->model::create([
                'name' => $request->name,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        $name = $request->name;
        return BaseController::success($name, 'Success Menambahkan Buku', 200);
    }
    public function updateBook($request, $id)
    {
        try {
            $book = $this->model::find($id);
            if ($book == NULL) {
                return BaseController::error(NULL, 'Data Notfound', 404);
            }
            $this->model::where('id', $id)->update([
                'name' => $request->name,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        $name = $request->name;
        return BaseController::success($name, 'Update Sukses', 200);
    }

    public function deleteBook($id)
    {
        try {
            $book = $this->model::find($id);
            if ($book == NULL) {
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
