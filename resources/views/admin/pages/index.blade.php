@extends('admin.main')

@section('content')
    <div class="main">

        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        {{--        @include('admin.templates.topbar')--}}
        <!--user image-->
{{--            <div class="user">--}}
{{--                <img src="/assets/img/user.png" alt="">--}}
{{--            </div>--}}
        </div>

        <!-- cards -->
        @include('admin.templates.cards')
        <div class="details">
            <!-- data list -->
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>@lang('main.recent_orders')</h2>
                    <a href="{{ route('order.index') }}" class="btn">@lang('main.view_all')</a>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td>#id</td>
                        <td>@lang('main.name')</td>
                        <td>@lang('main.phone')</td>
                        <td>@lang('main.created_date')</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recent_orders as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- New Customers -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>@lang('main.recent_added_dacha')</h2>
                </div>
                <table>
                    @foreach($recent_dacha as $dacha)
                        <tr>
                            <td>
                                <div class="imgBx">
                                    @if(!empty($dacha->images[0]->image_path))
                                        <img src="/{{ $dacha->images[0]->image_path }}">
                                    @else
                                        <img src="/assets/img/default.png">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <h4>
                                    {{ $dacha->name_ru }} <br>
                                    <span>@if(!empty($dacha->category->name_ru))
                                            {{ $dacha->category->name_ru }}
                                            @else
                                                not found
                                            @endif
                                    </span>
                                </h4>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
