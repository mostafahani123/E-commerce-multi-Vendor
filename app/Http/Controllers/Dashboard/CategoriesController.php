<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //Return Collection object
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
       return view('dashboard.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //#####request Merg##########
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $category =  Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success','Category Created Success');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $category =  Category::find($id);
      return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

         //handle url when write Id Not access

        try{
            $category =  Category::findOrFail($id);

        }catch(Exception $e){
           return redirect()->route('dashboard.categories.index')->with('info', 'Category ERROR PAGE');
        }

        //SELECT * FROM categories
        $parents = Category::where('id', '<>', $id)
        ->where(function($query) use ($id){
            $query->whereNull('parent_id')
           ->orwhere('parent_id', '<>', $id);
               })
        ->get();

        return view('dashboard.categories.edit', compact('category','parents'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $category->update($request->all());
        return Redirect::route('dashboard.categories.index')->with('success', 'Category update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return Redirect::route('dashboard.categories.index')->with('success', 'Category delete success');

    }
}
