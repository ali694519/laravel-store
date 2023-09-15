 @extends('layouts.dahboard')

 @section('title', 'Products')

 @section('breadcrumb')
   @parent
   <li class="breadcrumb-item active">Products</li>
 @endsection

 @section('content')

   <div class="mb-5">
     <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
   </div>

   <x-alert type="success" message="success" />
   <x-alert type="danger" message="danger" />

   <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
     <x-form.input name="name" placeholder="Search" :value="request('name')" />
     <select name="status" class="form-control mx-2">
       <option value="">All</option>
       <option value="active" @selected(request('status') == 'active')>Active</option>
       <option value="draft" @selected(request('status') == 'draft')>Draft</option>
       <option value="archived" @selected(request('status') == 'archived')>Archived</option>
     </select>
     <button type="submit" class="btn btn-dark mx-2">Fillter</button>
   </form>

   <table class="table">
     <thead>
       <tr>
         <th></th>
         <th>ID</th>
         <th>Name</th>
         <th>Category</th>
         <th>Store</th>
         <th>Status</th>
         <th>Created At</th>
         <th colspan="2"></th>
       </tr>
     </thead>



     <tbody>
       @forelse($products as $product)
         <tr>

           <td> <img src="{{ $product->image }}" alt="" height="50"> </td>
           <td>{{ $product->id }}</td>
           <td>{{ $product->name }}</td>
           <td>{{ $product->category->name }}</td>
           <td>{{ $product->store->name }}</td>
           <td>{{ $product->status }}</td>
           <td>{{ $product->created_at }}</td>
           <td>
             <a href="{{ route('dashboard.products.edit', $product->id) }}"
               class="btn btn-sm btn-outline-success">Edit</a>
           </td>
           <td>
             <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
               @csrf
               {{-- Form Method Spoofing --}}
               <input type="hidden" name="_method" value="delete">
               @method('delete')
               <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
             </form>
           </td>
         </tr>
       @empty
         <tr>
           <td colspan="9">No Products defined.</td>
         </tr>
       @endforelse

     </tbody>
   </table>

   {{ $products->withQueryString()->links() }}


 @endsection
