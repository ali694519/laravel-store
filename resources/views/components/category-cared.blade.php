<!-- Start Single Category -->
<div class="single-category">
  <h3 class="heading">{{ $category->name }}</h3>
  <ul>
    <li><a href="product-grids.html">{{ $category->name }}</a></li>
    <li><a href="product-grids.html">QLED TV</a></li>
    <li><a href="product-grids.html">Audios</a></li>
    <li><a href="product-grids.html">Headphones</a></li>
    <li><a href="product-grids.html">View All</a></li>
  </ul>
  <div class="image">
    <img src="{{ asset('storage/' . $category->image) }}" alt="#">

  </div>
</div>
<!-- End Single Category -->
