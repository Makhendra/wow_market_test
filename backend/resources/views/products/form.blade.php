@extends('layouts.app')

@section('title', $title)


@section('content')

    <div class="row">

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            {{ $method }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label" for="code">{{ __('texts.product_code') }}</label>
                <input name="code" id="code" type="text" class="form-control" value="{{ $product->code ?? '' }}"
                       required>
            </div>
            <div class="form-group">
                <label class="control-label" for="name">{{ __('texts.product_name') }}</label>
                <input name="name" id="name" type="text" class="form-control" value="{{ $product->name ?? '' }}" required>
            </div>
            <div class="form-group row">

                @if(isset($product) && $product->images()->first())
                    <div class="col-md-2">
                        @include('products.image', $product)
                        <input type="checkbox" name="image_delete" value="1" id="image_delete">
                        <label class="control-label" for="image_delete">{{ __('texts.delete') }}</label>
                    </div>
                @endif

                <div class="col-md-10">
                    <label class="control-label" for="image">{{ __('texts.product_image') }}</label>
                    <input name="image" id="image" type="file" value="{{ $product->image ?? '' }}">
                    <p class="mt-5 text-grey">JPG, JPEG, or PNG imgae with resolution from 100x100px to 500x500px. Max
                        file
                        size is 250kb.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="description">{{ __('texts.description') }}</label>
                <textarea name="description" id="description" cols="30" rows="10"
                          class="form-control">{{ $product->description ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('texts.save_product') }}
            </button>
        </form>
    </div>
@endsection