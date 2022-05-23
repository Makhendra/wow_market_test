@extends('layouts.main')

@section('title', $title)


@section('content')
    <form action="{{ $action }}" method="POST">
        {{ $method }}
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group">
                <label class="control-label" for="name">{{ __('texts.user_name') }}</label>
                <input name="name" id="name" type="text" class="form-control" value="{{ $user->name ?? '' }}" required>
            </div>

            <div class="form-group">
                <label class="control-label" for="email">{{ __('texts.email') }}</label>
                <input name="email" id="email" type="email" class="form-control" value="{{ $user->email ?? '' }}" required>
            </div>

            <div class="form-group">
                <label class="control-label" for="role_id">{{ __('texts.role') }}</label>
                <select name="role_id" id="role_id" class="form-control">
                    @foreach($roles as $role)
                        <option class="form-control" value="{{ $role->id }}"
                        @if(isset($user) && $user->role_id == $role->id) selected @endif >
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="password">{{ __('texts.password') }}</label>
                <input name="password" id="password" type="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('texts.save_user') }}
            </button>
        </div>
    </form>
@endsection