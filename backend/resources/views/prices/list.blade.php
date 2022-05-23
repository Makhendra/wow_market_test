@extends('layouts.main')

@section('title', __('texts.price_lists'))

@section('content')
    <form action="{{ $action }}" method="POST" id="generate-form">
        {{ $method }}
        {{ csrf_field() }}
        <div class="row">
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
                <label class="control-label" for="starts_at">{{ __('texts.start_date_and_time') }}</label>
                <input name="starts_at" id="starts_at" type="datetime-local" step="1" class="form-control" value="{{$today}}" required>
            </div>

            <button type="button" class="btn btn-primary generate-price">
                {{ __('texts.show_price_list') }}
            </button>
        </div>
    </form>

    <div id="price_list"></div>

    <script>
        $('.generate-price').click(function (e) {
            e.preventDefault()
            let form = $('#generate-form');
            let action = form.attr('action');
            let data = form.serialize();

            $.post(action, data, function (response) {
                $('#price_list').empty().prepend(response.html);
            })
                .fail(function () {
                    alert("error");
                });
        });
    </script>
@endsection