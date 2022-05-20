@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="row">

        <form action="{{ $action }}" method="POST">
            {{ $method }}
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="product_id">{{ __('texts.product_id_or_code') }}</label>
                <select class="select2 form-control" name="product_id" id="product_id" required>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}[{{$product->code}}]</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <label class="control-label" for="store_id">{{ __('texts.store') }}</label>
                <select name="store_id" id="store_id" class="form-control">
                    <option class="form-control" value="null">{{__('texts.all')}}</option>
                    @foreach($stores as $store)
                        <option class="form-control" value="{{ $store->id }}">
                            {{ $store->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="price">{{ __('texts.price') }}</label>
                <input name="price" type="number" id="price" class="form-control" value="" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="control-label" for="starts_at">{{ __('texts.start_date_and_time') }}</label>
                <input name="starts_at" id="starts_at" type="datetime-local" step="1" class="form-control" value="{{$today}}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('texts.add_product_price') }}
            </button>
        </form>
    </div>
@endsection