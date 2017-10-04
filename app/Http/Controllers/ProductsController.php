<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    protected $path = 'products.';

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
    }

    public function getList(Request $request)
    {
        $aProducts = Product::with('tags');
        $this->activateFilters($request, $aProducts);
        $aProducts = $aProducts->get()->toJson();

        return $aProducts;
    }

    protected function activateFilters(Request $request, &$aProducts)
    {
        $data = $request->only('name', 'description', 'photo_description');
        $tag = $request->get('tag');

        $aProducts->where(function($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->orWhere($key, 'LIKE', "%$value%");
            }
        });

        if($tag){
            $aProducts->whereHas('tags', function ($query) use ($tag) {
                $query->where('text', 'like', '%' . $tag . '%');
            });
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aCategories = Category::all()->pluck('name', 'id')->all();
        $aTags = Tag::all()->pluck('text', 'id')->all();
        return view($this->path . 'form', compact('aCategories', 'aTags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if($request->hasFile('photo')){
            $request->file('photo')->move(public_path('upload/products'), $request->file('photo')->getClientOriginalName());
            $data = $request->except(['photo', 'tags']);
            $data['photo'] = '/upload/products/' . $request->file('photo')->getClientOriginalName();
        }else{
            $data = $request->all();
        }
        $data['user_id'] = Auth::id();

        $oProduct = Product::create($data);
        $oProduct->tags()->sync($request->get('tags'));

        $result = ['success' => config('constants.response.added')];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oProduct = Product::find($id);

        if(is_object($oProduct)){
            if($oProduct->can_edit()){
                $aCategories = Category::all()->pluck('name', 'id')->all();
                $aTags = Tag::all()->pluck('text', 'id')->all();

                return view($this->path . 'form', compact('oProduct', 'aCategories', 'aTags'));
            }else{
                $result = ['error' => config('constants.response.no_permissions')];
            }
        }else{
            $result = ['error' => config('constants.response.not_found')];
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
    public function update(ProductRequest $request, $id)
    {
        $oProduct = Product::find($id);
        if(is_object($oProduct)){
            if($oProduct->can_edit()){
                if($request->hasFile('photo')){
                    $request->file('photo')->move(public_path('upload/products'), $request->file('photo')->getClientOriginalName());
                    $data = $request->except(['photo']);
                    $data['photo'] = $request->file('photo')->getClientOriginalName();
                }else{
                    $data = $request->all();
                }
               $oProduct->update($data);
               $oProduct->tags()->sync($request->get('tags'));

               $result = ['success' => config('constants.response.updated')];
            }else{
                $result = ['error' => config('constants.response.no_permissions')];
            }
        }else{
            $result = ['error' => config('constants.response.not_found')];
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oProduct = Product::find($id);
        if(is_object($oProduct)){
            if($oProduct->can_edit()){
                $oProduct->delete();
                $result = ['success' => config('constants.response.deleted')];
            }else{
                $result = ['error' => config('constants.response.no_permissions')];
            }
        }else{
            $result = ['error' => config('constants.response.not_found')];
        }

        return response()->json($result);
    }
}
