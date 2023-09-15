<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $request = request();
        //SELECT * FROM products
        //SELECT * FROM categories WHERE id IN (*)
        //SELECT * FROM stores WHERE id IN (*)
        $products = Product::filter($request->query())
        ->with('category','store')
        ->paginate();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $product = new Product();
        return view('dashboard.products.create',compact('product','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //Request merge
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->except('image','tags');

       
        $data['image'] = $this->UploadImage($request);

        $product = Product::create($data);

        $tags = $request->post('tags');
        $slug = Str::slug($tags);

        $tag = Tag::create([
            'name'=>$tags,
            'slug'=>$slug,
        ]);

        $product->tags()->sync($tag->id);

       return redirect()->route('dashboard.products.index')
       ->with('success','Product Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $tags = implode(',',$product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags = explode(',',$request->post('tags'));

        // $tags = json_decode($request->post('tags'));
        $tag_ids = [];
        $saved_tags = Tag::all();
        foreach($tags as $item) {
            $slug = Str::slug($item);
            $tag  =$saved_tags->where('slug',$slug)->first();
            if(!$tag)
            {
                $tag = Tag::create([
                    'name'=>$item,
                    'slug'=>$slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')
        ->with('success','Product Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
