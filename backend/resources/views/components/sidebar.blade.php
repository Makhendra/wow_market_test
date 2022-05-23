<div class="text-center">
    <img src="{{asset('images/logo.svg')}}" class="logo" alt="Logo">
</div>
<div class="list-group">
    @if($global_permissions[$current_permission::SECTION_PRODUCTS][$current_permission::ACTION_SHOW])
        <a href="{{ route('products.index') }}"
           class="list-group-item @if(url()->current() == route('products.index')) active @endif">
            {{ __('texts.products') }}
        </a>
    @endif
    @if($global_permissions[$current_permission::SECTION_STORES][$current_permission::ACTION_SHOW])
        <a href="{{ route('stores.index') }}"
           class="list-group-item @if(url()->current() == route('stores.index')) active @endif">
            {{ __('texts.stores') }}
        </a>
    @endif
    @if($global_permissions[$current_permission::SECTION_PRICES][$current_permission::ACTION_CREATE])
        <a href="{{ route('prices.index') }}"
           class="list-group-item @if(url()->current() == route('prices.index')) active @endif">
            {{ __('texts.prices') }}
        </a>
    @endif
    @if($global_permissions[$current_permission::SECTION_PRICES][$current_permission::ACTION_SHOW])
        <a href="{{ route('prices.lists') }}"
           class="list-group-item @if(url()->current() == route('prices.lists')) active @endif">
            {{ __('texts.price_lists') }}
        </a>
    @endif
    @if($global_permissions[$current_permission::SECTION_USERS][$current_permission::ACTION_SHOW])
        <a href="{{ route('users.index') }}"
           class="list-group-item @if(url()->current() == route('users.index')) active @endif">
            {{ __('texts.users') }}
        </a>
    @endif
    @if($global_permissions[$current_permission::SECTION_ROLES][$current_permission::ACTION_SHOW])
        <a href="{{ route('roles.index') }}"
           class="list-group-item @if(url()->current() == route('roles.index')) active @endif">
            {{ __('texts.roles') }}
        </a>
    @endif

    <hr class="mt-5">

    <a href="{{ route('logout') }}" class="list-group-item"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ __('texts.logout')}}
    </a>

    @if($global_permissions[$current_permission::SECTION_ROLES][$current_permission::ACTION_EDIT])
        <a href="{{ route('users.edit', Auth::id()) }}" class="list-group-item">
            {{ __('texts.edit_user')}}
        </a>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

</div>