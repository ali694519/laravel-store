 @extends('layouts.dahboard')

 @section('title', 'Trash Categories')

 @section('breadcrumb')
   @parent
   <li class="breadcrumb-item">Categories</li>
   <li class="breadcrumb-item active">Trash</li>
 @endsection

 @section('content')

   <div class="mb-5">
     <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
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
         <th>Status</th>
         <th>Deleted At</th>
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
           <td>{{ $category->name }}</td>
           <td>{{ $category->status }}</td>
           <td>{{ $category->deleted_at }}</td>
           <td>
             <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST">
               @csrf
               @method('put')
               <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
             </form>
           </td>
           <td>
             <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="POST">
               @csrf
               @method('delete')
               <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
             </form>
           </td>
         </tr>
       @empty
         <tr>
           <td colspan="7">No Categories defined.</td>
         </tr>
       @endforelse

     </tbody>
   </table>

   {{ $categories->withQueryString()->links() }}


 @endsection
