@extends('layouts.app')

@section('title', __('texts.roles'))


@section('button')
    <a href="{{ route('roles.create') }}" class="btn btn-primary">{{ __('texts.add_new')  }}</a>
@endsection


@section('content')

    @if ($roles->count() == 0)
        {{ __('texts.empty_list') }}
    @else
        @foreach($roles as $role)
            <div class="row mb-10 border-light-grey">
                <div class="p-15">
                    <div class="col-md-8">
                        <h4 class="media-heading">{{ $role->role }} #{{ $role->id }}</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('roles.edit', $role->id) }}"
                           class="btn btn-sm btn-primary">{{ __('texts.edit') }}</a>
                        <form method="POST"
                              class="d-inline-block"
                              action="{{ route('roles.destroy', $role->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button
                                    type="button"
                                    class="btn btn-sm btn-danger delete"
                                    title='{{ __('texts.delete') }}'
                            >
                                {{ __('texts.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $roles->links() }}

    @endif

@endsection