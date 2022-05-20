@extends('layouts.app')

@section('title', __('texts.stores'))


@section('button')
    <a href="{{ route('stores.create') }}" class="btn btn-primary">{{ __('texts.add_new')  }}</a>
@endsection


@section('content')
    @if ($stores->count() == 0)
        {{ __('texts.empty_list') }}
    @else
        @foreach($stores as $store)
            <div class="row mb-10 border-light-grey">
                <div class="p-15">
                    <div class="col-md-8">
                        <h4 class="media-heading">{{ $store->name }}</h4>
                        {{ $store->short_description }}
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('stores.edit', $store->id) }}"
                           class="btn btn-sm btn-primary">{{ __('texts.edit') }}</a>
                        <form method="POST"
                              class="d-inline-block"
                              action="{{ route('stores.destroy', $store->id) }}">
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

        {{ $stores->links() }}

    @endif

@endsection