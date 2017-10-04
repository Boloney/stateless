<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    protected $path = 'categories.';

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aCategories = Category::all()->pluck('name', 'id')->all();
        return view($this->path . 'form', compact('aCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        Category::create($data);
        $result = ['success' => config('constants.response.added')];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->can('edit', $category)) {
                $aCategories = Category::all()->pluck('name', 'id')->all();
                return view($this->path . 'form', compact('category', 'aCategories'));
        } else {
            $result =  ['error' => config('constants.response.no_permissions')];
        }

        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if (Auth::user()->can('edit', $category)) {
            $category->update($request->all());
            $result = ['success' => config('constants.response.updated')];
        }else{
            $result = ['error' => config('constants.response.no_permissions')];
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->can('edit', $category)) {
            $category->delete();
            $result = ['success' => config('constants.response.deleted')];
        }else{
            $result = ['error' => config('constants.response.no_permissions')];
        }

        return response()->json($result);
    }
}
