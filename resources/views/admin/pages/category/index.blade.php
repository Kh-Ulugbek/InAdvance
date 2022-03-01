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
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>@lang('main.categories')</h2>
                    <a href="{{ route('categories.create') }}" class="btn">@lang('main.add_new') +</a>
                </div>
                <form method="get" action="{{ route('categories.index') }}" class="filter">
                    <div class="filter__input">
                        <input placeholder="@lang('main.name')..." name="name" type="text"
                               @if(!empty(request()->get('name'))) value="{{ request()->get('name') }}"@endif >
                    </div>
                    <button class="filter__button" type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                        @lang('main.search')
                    </button>
                </form>
                <table>
                    <thead>
                    <tr>
                        <td>#id</td>
                        <td>@lang('main.name')</td>
                        <td>@lang('main.image')</td>
                        <td>@lang('main.created_date')</td>
                        <td>@lang('main.actions')</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name_ru }}</td>
                            <td class="imageColumn">
                                <div class="imgBx">
                                    <img src="{{ $category->image_path }}">
                                </div>
                            </td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
{{--                                <a href="{{ route('categoryDelete', $category->id) }}">--}}
                                <a onclick="openModal({{ $category->id }})" >
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal content -->
                        <div id="modal_container{{ $category->id }}" class="modal-container">
                            <div class="modal">
                                <div class="modal__header">
                                    <h2>Пожалуйста подтвердите действие</h2>
                                    <a class="modal__close" href="#" onclick="closeModal({{ $category->id }})" id="close{{ $category->id }}">
                                        <ion-icon name="close-outline"></ion-icon>
                                    </a>
                                </div>
                                <form method="post" action="{{ route('categories.destroy', $category->id) }}" class="modal__form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete">
                                        <button class="modal__delete" type="submit">
                                            Delete <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.templates.paginate', ['items' => $categories])
        </div>
    </div>
@endsection

@section('js')
    <script>
        function openModal(id) {
            let modal_container = document.getElementById('modal_container'+id);
            modal_container.classList.add('show')
        }
        function closeModal(id) {
            let modal_container = document.getElementById('modal_container'+id);
            modal_container.classList.remove('show')
        }

    </script>
@endsection
