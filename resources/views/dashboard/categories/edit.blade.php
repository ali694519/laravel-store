 @extends('layouts.dahboard')

 @section('title', 'Edit Categories')

 @section('breadcrumb')
   @parent
   <li class="breadcrumb-item active">Categories</li>
   <li class="breadcrumb-item active">Edit Categories</li>
 @endsection

 @section('content')




   <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
     @csrf
     @method('put')
     @include('dashboard.categories._form', [
         'button_label' => 'Update',
     ])
   </form>


 @endsection
