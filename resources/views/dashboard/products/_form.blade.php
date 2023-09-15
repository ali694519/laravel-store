@if ($errors->any())
  <div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<div class="form-group">
  <x-form.input label="Product Name" name="name" role="input" :value="$product->name" />
</div>


<div class="form-group">
  <label for="">categories</label>
  <select name="category_id" class="form-control form-select">
    <option value="">primary Category</option>
    @foreach (App\Models\Category::all() as $category)
      <option value="{{ $category->id }}"@selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
    @endforeach
  </select>
</div>




<div class="form-group">
  <label for="">Store</label>
  <select name="store_id" class="form-control form-select">
    <option value="">primary Store</option>
    @foreach (App\Models\Store::all() as $store)
      <option value="{{ $store->id }}"@selected(old('store_id', $product->store_id) == $store->id)>{{ $store->name }}</option>
    @endforeach
  </select>
</div>







<div class="form-group">

  <x-form.textarea label="Description" name="description" :value="$product->description" />
</div>

<div class="form-group">
  <x-form.label id="image">
    Image
  </x-form.label>
  <x-form.input type="file" name="image" accept="image/*" />
  @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="" height="50">
  @endif
</div>

<div class="form-group">
  <x-form.input label="Price" name="price" role="input" :value="$product->price" type="number" />
</div>

<div class="form-group">
  <x-form.input label="Compare Price" name="compare_price" role="input" :value="$product->compare_price" type="text" />
</div>

<div class="form-group">
  <x-form.input label="Options" name="options" role="input" :value="$product->options" type="text" />
</div>


<div class="form-group">
  <x-form.input label="Rating" name="rating" role="input" :value="$product->rating" type="number" />
</div>

<div class="form-group">
  <x-form.input label="Featured" name="featured" role="input" :value="$product->featured" type="number" />
</div>


<div class="form-group">
  <x-form.input label="Tags" name="tags" role="input" :value="$tags ?? ''" />
</div>

<div class="form-group">
  <label for="">Status</label>
  <div>

    <x-form.radio name="status" :checked="$product->status" :options="['active' => 'active', 'draft' => 'draft', 'archived' => 'Archived']" />
  </div>
</div>




<div class="form-group">
  <button type="submit" class="btn btn-sm btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/cdn.jsdelivr.net_npm_@yaireo_tagify_dist_tagify.css') }}">
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

  <script src="{{ asset('js/cdn.jsdelivr.net_npm_@yaireo_tagify_dist_tagify.polyfills.min.js') }}"></script>
  <script src="{{ asset('js/cdn.jsdelivr.net_npm_@yaireo_tagify.js') }}"></script>
  <script>
    var inputElm = document.querySelector('name=tags'),
      tagify = new Tagify(inputElm);
  </script>
@endpush
