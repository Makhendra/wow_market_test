@extends('layouts.app')

@section('title', $title)


@section('content')

    <form action="{{ $action }}" method="POST">
        {{ $method }}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group">
                <label class="control-label" for="role">{{ __('texts.role') }}</label>
                <input name="role" id="role" type="text" class="form-control" value="{{ $role->role ?? '' }}" required>
            </div>
            <br/>

            <button type="submit" class="btn btn-primary">
                {{ __('texts.save_role') }}
            </button>
        </div>
    </form>
@endsection