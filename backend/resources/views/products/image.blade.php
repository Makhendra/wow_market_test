@if($product->images()->first())
    @php
        $path = asset('/storage/'.$product->images()->first()->path) @endphp
@else
    @php
        $path = asset('/images/not_found.png')
    @endphp
@endif
<img class="image" src="{{$path}}" alt="{{ $product->name }}">