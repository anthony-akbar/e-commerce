@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_title">{{ trans('cruds.product.fields.product_title') }}</label>
                <input class="form-control {{ $errors->has('product_title') ? 'is-invalid' : '' }}" type="text" name="product_title" id="product_title" value="{{ old('product_title', $product->product_title) }}" required>
                @if($errors->has('product_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_image">{{ trans('cruds.product.fields.product_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('product_image') ? 'is-invalid' : '' }}" id="product_image-dropzone">
                </div>
                @if($errors->has('product_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_description">{{ trans('cruds.product.fields.product_description') }}</label>
                <textarea class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}" name="product_description" id="product_description">{{ old('product_description', $product->product_description) }}</textarea>
                @if($errors->has('product_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.productImageDropzone = {
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="product_image"]').remove()
      $('form').append('<input type="hidden" name="product_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="product_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($product) && $product->product_image)
      var file = {!! json_encode($product->product_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="product_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection