 @if (session()->has($type))
   <div class="alert alert-{{ $type }}">
     {{ session($message) }}
   </div>
 @endif
