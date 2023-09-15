 @extends('layouts.dahboard')

 @section('title', 'Categories')

 @section('breadcrumb')
   @parent
   <li class="breadcrumb-item active">Categories</li>
 @endsection

 @section('content')

   <div class="mb-5">
     <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>

     <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a>
   </div>

   <x-alert type="success" message="success" />
   <x-alert type="danger" message="danger" />

   <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
     <x-form.input name="name" placeholder="Search" :value="request('name')" />
     <select name="status" class="form-control mx-2">
       <option value="">All</option>
       <option value="active" @selected(request('status') == 'active')>Active</option>
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
         <th>Parent</th>
         <th>Products Number</th>
         <th>Status</th>
         <th>Created At</th>
         <th colspan="2"></th>
       </tr>
     </thead>


     <tbody>
       @forelse($categories as $category)
         <tr>
           <td>
             <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
           </td>
           <td>{{ $category->id }}</td>
           <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a> </td>
           <td>{{ $category->parent->name }}</td>
           <td>{{ $category->products_count }}</td>
           <td>{{ $category->status }}</td>
           <td>{{ $category->created_at }}</td>
           <td>
             <a href="{{ route('dashboard.categories.edit', $category->id) }}"
               class="btn btn-sm btn-outline-success">Edit</a>
           </td>
           <td>
             <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
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
           <td colspan="9">No Categories defined.</td>
         </tr>
       @endforelse

     </tbody>
   </table>

   {{ $categories->withQueryString()->links() }}


 @endsection
