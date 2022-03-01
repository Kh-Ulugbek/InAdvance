<div class="cardBox">
    <a style="text-decoration: none" href="{{ route('dacha.index') }}">
        <div class="card">
            <div>
                <div class="numbers">{{ number_format($dacha_count) }}</div>
                <div class="cardName">@lang('main.dacha')</div>
            </div>
            <div class="iconBox">
                <ion-icon name="home-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a style="text-decoration: none" href="{{ route('order.index') }}">
        <div class="card">
            <div>
                <div class="numbers">{{ number_format($orders_count) }}</div>
                <div class="cardName">@lang('main.orders')</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a style="text-decoration: none" href="{{ route('category.index') }}">
        <div class="card">
            <div>
                <div class="numbers">{{ number_format($location_count) }}</div>
                <div class="cardName">@lang('main.locations')</div>
            </div>
            <div class="iconBox">
                <ion-icon name="location-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a style="text-decoration: none">
        <div class="card">
            <div>
                <div class="numbers">{{ number_format($admins_count) }}</div>
                <div class="cardName">@lang('main.admins')</div>
            </div>
            <div class="iconBox">
                <ion-icon name="person-outline"></ion-icon>
            </div>
        </div>
    </a>
</div>
