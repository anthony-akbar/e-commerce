@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="clietn_name">{{ trans('cruds.client.fields.clietn_name') }}</label>
                <input class="form-control {{ $errors->has('clietn_name') ? 'is-invalid' : '' }}" type="text" name="clietn_name" id="clietn_name" value="{{ old('clietn_name', '') }}" required>
                @if($errors->has('clietn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clietn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.clietn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cleint_number">{{ trans('cruds.client.fields.cleint_number') }}</label>
                <input class="form-control {{ $errors->has('cleint_number') ? 'is-invalid' : '' }}" type="number" name="cleint_number" id="cleint_number" value="{{ old('cleint_number', '') }}" step="1">
                @if($errors->has('cleint_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cleint_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.cleint_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="client_address">{{ trans('cruds.client.fields.client_address') }}</label>
                <input class="form-control {{ $errors->has('client_address') ? 'is-invalid' : '' }}" type="text" name="client_address" id="client_address" value="{{ old('client_address', '') }}">
                @if($errors->has('client_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.client.fields.client_address_helper') }}</span>
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