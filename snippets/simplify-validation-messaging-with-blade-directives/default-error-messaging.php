<div class="form-group">
  <label for="input-title">Title</label>
  <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="input-title">
  {!! $errors->has('subtitle') ? $errors->first('subtitle', '<div class="invalid-feedback">:message</div>') : '' !!}
</div>
