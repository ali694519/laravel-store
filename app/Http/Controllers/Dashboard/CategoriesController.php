<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        //SELECT a.*,b.name as parent_name FROM categories as a
        //INNER JOIN categories as b ON b.id = a.parent_id
        $categories = Category::

        /*leftJoin('categories as parents','parents.id','=','categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])*/
        withCount('products')
        ->filter($request->query())
        ->orderBy('categories.name')
        ->paginate();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

       //Request merge
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');

       $data['image'] = $this->UploadImage($request);

       $category = Category::create($data);
       //PRG
       return redirect()->route('dashboard.categories.index')
       ->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',[
            'category'=>$category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id','<>',$id)
        ->where(function($query) use($id) {
            $query->WhereNull('parent_id')
        ->orWhere('parent_id','<>',$id);
        })->get();

        return view('dashboard.categories.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {

        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        $new_image = $this->UploadImage($request);
        if($new_image) {
            $data['image'] = $new_image;
        }

        $category->update($data);
        // $category->fill($request->all())->save();
        if($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
          return redirect()->route('dashboard.categories.index')
       ->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        // if($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }
           return redirect()->route('dashboard.categories.index')
        ->with('danger','Category deleted!');
    }


    protected function UploadImage(Request $request) {
          if(!$request->hasFile('image')) {
            return;
          }
            $file = $request->file('image'); // UploadedFile Object
            $path = $file->store('uploads','public');
            $data['image'] = $path;
            return $path;
        }

        public function trash() {
            $categories = Category::onlyTrashed()->paginate();
            return view('dashboard.categories.trash',compact('categories'));
        }
         public function restore(Request $request, $id) {

            $category = Category::onlyTrashed()->findOrFail($id);
            $category->restore();

            return redirect()->route('dashboard.categories.trash')
            ->with('success','Category restored!');
        }

         public function forceDelete($id) {

            $category = Category::onlyTrashed()->findOrFail($id);
            $category->forceDelete();
            if($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            return redirect()->route('dashboard.categories.trash')
            ->with('danger','Category deleted!');
        }
    }
