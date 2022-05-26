<table class="table table-responsive" id="table_price_list">
    <caption>Table prices</caption>
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('texts.product_code') }}</th>
        <th>{{ __('texts.product_name') }}</th>
        <th>{{ __('texts.price') }}</th>
    </tr>
    </thead>
    <tbody id="table_body_price_list">
    @foreach($prices as $price)
        <tr>
            <td>{{ $price->id }}</td>
            <td>{{ $price->code }}</td>
            <td>{{ $price->name }}</td>
            <td>{{ $price->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $prices->links() }}