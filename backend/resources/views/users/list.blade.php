@extends('layouts.main')

@section('title', __('texts.users'))


@section('button')
    @if($global_permissions[$current_permission::SECTION_USERS][$current_permission::ACTION_CREATE])
        <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('texts.add_new')  }}</a>
    @endif
@endsection


@section('content')
    @if ($users->count() == 0)
        {{ __('texts.empty_list') }}
    @else
        @foreach($users as $user)
            <div class="row mb-10 border-light-grey">
                <div class="p-15">
                    <div class="col-md-8">
                        <h4 class="media-heading">{{ $user->name }} #{{ $user->id }}</h4>
                        {{ $user->role->role }}
                    </div>
                    <div class="col-md-2">
                        @if($global_permissions[$current_permission::SECTION_USERS][$current_permission::ACTION_EDIT])
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="btn btn-sm btn-primary">{{ __('texts.edit') }}</a>
                        @endif
                        @if($global_permissions[$current_permission::SECTION_USERS][$current_permission::ACTION_DELETE])
                            <form method="POST"
                                  class="d-inline-block"
                                  action="{{ route('users.destroy', $user->id) }}">
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
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{ $users->links() }}

    @endif

@endsection