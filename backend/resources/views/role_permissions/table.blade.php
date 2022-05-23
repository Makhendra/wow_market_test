<table class="table table-responsive" id="table_price_list">
    <caption>Table permissions</caption>
    <thead>
    <tr>
        <th>{{ __('texts.section') }}</th>
        <th colspan="4">{{ __('texts.actions') }}</th>
    </tr>
    </thead>
    <tbody id="table_body_price_list">
    @foreach($permissions as $section => $permission)
        <tr>
            <td>{{ $section }}</td>
            @foreach($permission as $action => $is_enabled)
            <td>{{ $action }}
                <input type="checkbox" name="{{ "permissions_data[$section][$action]"}}"
                       @if($is_enabled)checked @endif value="1">
            </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>