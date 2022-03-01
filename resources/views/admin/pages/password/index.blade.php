@extends('admin.main')

@section('content')
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <!--user image-->
{{--            <div class="user">--}}
{{--                <img src="/assets/img/user.png" alt="">--}}
{{--            </div>--}}
        </div>
        <div class="details singleColumn">
            <!-- data list -->
            <div class="itemsCard">
                <div class="cardHeader">
                    <h2>@lang('main.security')</h2>
                </div>
                <div class="form">
                    <form method="post" action="{{ route('passwordChange') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form__input">
                            <label>
                                @lang('main.current_password')
                            </label>
                            @error('current_password')
                            <span class="validationError">{{ $message  }}</span>
                            @enderror
                            <input name="current_password" type="password">
                        </div>
                        <div class="form__input">
                            <label>
                                @lang('main.new_password')
                            </label>
                            @error('password')
                            <span class="validationError">{{ $message  }}</span>
                            @enderror
                            <input name="password" type="password">
                        </div>
                        <div class="form__input">
                            <label>
                                @lang('main.confirm_new_password')
                            </label>
                            @error('confirm')
                            <span class="validationError">{{ $message  }}</span>
                            @enderror
                            <input name="confirm" type="password">
                        </div>
                        <div class="form__btn">
                            <button type="submit">@lang('main.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
