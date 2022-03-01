<div class="navigation">
    <ul>
        <li>
            <a href="#">
                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                <span class="title">Admin Panel</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><ion-icon name="bar-chart-outline"></ion-icon></span>
                <span class="title">@lang('main.dashboard')</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                <span class="title">@lang('main.users')</span>
            </a>
        </li>
        <li class="{{ (request()->is('restaurants*')) ? 'active' : '' }}">
            <a href="{{ route('restaurants.index') }}">
                <span class="icon"><ion-icon name="restaurant-outline"></ion-icon></span>
                <span class="title">@lang('main.restaurants')</span>
            </a>
        </li>
        <li class="{{ (request()->is('categories*')) ? 'active' : '' }}" >
            <a href="{{ route('categories.index') }}">
                <span class="icon"><ion-icon name="pricetags-outline"></ion-icon></span>
                <span class="title">@lang('main.categories')</span>
            </a>
        </li>
        <li class="{{ (request()->is('meals*')) ? 'active' : '' }}">
            <a href="{{ route('meals.index') }}">
                <span class="icon"><ion-icon name="fast-food-outline"></ion-icon></span>
                <span class="title">@lang('main.meals')</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                <span class="title">@lang('main.security')</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                <span class="title">@lang('main.sign_out')</span>
            </a>
        </li>
    </ul>
</div>
