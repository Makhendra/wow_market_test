@extends('layouts.app')

@section('title', __('texts.products'))


@section('button')
    <a href="{{ route('products.create') }}" class="btn btn-primary">{{ __('texts.add_new')  }}</a>
@endsection


@section('content')
    @if ($products->count() == 0)
        {{ __('texts.empty_list') }}
    @else
        @foreach($products as $product)
            <div class="row mb-10 border-light-grey">
                <div class="col-md-2 p-none">
                    @include('products.image', $product)
                </div>
                <div class="p-15">
                    <div class="col-md-8">
                        <h4 class="media-heading">{{ $product->name }}</h4>
                        {{ $product->short_description }}
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="btn btn-sm btn-primary">{{ __('texts.edit') }}</a>
                        <form method="POST"
                              class="d-inline-block"
                              action="{{ route('products.destroy', $product->id) }}">
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

        {{ $products->links() }}

    @endif

@endsection