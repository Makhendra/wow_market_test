<div class="text-center">
    <img src="{{asset('images/logo.svg')}}" class="logo" alt="Logo">
</div>
<div class="list-group">
    <a href="{{ route('products.index') }}"
       class="list-group-item @if(url()->current() == route('products.index')) active @endif">
        {{ __('texts.products') }}
    </a>
    <a href="{{ route('stores.index') }}"
       class="list-group-item @if(url()->current() == route('stores.index')) active @endif">
        {{ __('texts.stores') }}
    </a>
    <a href="{{ route('prices.index') }}" class="list-group-item @if(url()->current() == route('prices.index')) active @endif">
        {{ __('texts.prices') }}
    </a>
    <a href="{{ route('prices.lists') }}"
       class="list-group-item @if(url()->current() == route('prices.lists')) active @endif">
        {{ __('texts.price_lists') }}
    </a>
    <a href="{{ route('users.index') }}"
       class="list-group-item @if(url()->current() == route('users.index')) active @endif">
        {{ __('texts.users') }}
    </a>
    <a href="{{ route('roles.index') }}"
       class="list-group-item @if(url()->current() == route('roles.index')) active @endif">
        {{ __('texts.roles') }}
    </a>
</div>