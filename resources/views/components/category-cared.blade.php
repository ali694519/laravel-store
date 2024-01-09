<!-- Start Single Category -->
<div class="single-category">
  <h5 class="card-title">{{ $category->name }}</h5>
  <div class="image">
    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100px; height:100px">
  </div>
</div>
<!-- End Single Category -->
