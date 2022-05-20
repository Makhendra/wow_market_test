@extends('layouts.app')

@section('title', $title)


@section('content')
    <form action="{{ $action }}" method="POST">
        {{ $method }}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group">
                <label class="control-label" for="name">{{ __('texts.store_name') }}</label>
                <input name="name" id="name" type="text" class="form-control" value="{{ $store->name ?? '' }}" required>
            </div>
            <br/>
            <div class="form-group">
                <label class="control-label" for="description">{{ __('texts.description') }}</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ $store->description ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('texts.save_role') }}
            </button>
        </div>
    </form>
@endsection