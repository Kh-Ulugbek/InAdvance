@extends('admin.main')

@section('content')
    <div class="main">

        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
        <div class="details singleColumn">
            <!-- data list -->
            <div class="itemsCard">
                <div class="cardHeader">
                    <h2>@lang('main.add_meal')</h2>
                </div>
                <div class="form">
                    <form method="post" action="{{ route('meals.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('admin.pages.meal.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
