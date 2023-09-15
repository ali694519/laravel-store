 @extends('layouts.dahboard')

 @section('title', 'Categories')

 @section('breadcrumb')
   @parent
   <li class="breadcrumb-item active">Categories</li>
 @endsection

 @section('content')




   <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
     @csrf
    @include('dashboard.categories._form')
   </form>


 @endsection
