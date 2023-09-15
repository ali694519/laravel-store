<select name="{{ $name }}" class="form-select form-control @error($name) is-invalid @enderror">

  @foreach ($options as $value => $text)
    <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
  @endforeach
</select>
