@extends('layouts.main')

@section('title', $title)


@section('content')
    <div class="row">
        <form action="{{ $action }}" method="POST">
            {{ $method }}
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="role">{{ __('texts.role') }}</label>
                <input name="role" id="role" type="text" class="form-control" value="{{ $role->role ?? '' }}" required>
            </div>

            @include('role_permissions.table')

            <button type="submit" class="btn btn-primary">
                {{ __('texts.save_role') }}
            </button>

        </form>
    </div>
@endsection