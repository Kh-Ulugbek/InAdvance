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

        <!-- cards -->
        <div class="details singleColumn">
            <!-- data list -->
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>@lang('main.dacha')</h2>
                    <a href="{{ route('dacha.create') }}" class="btn">@lang('main.add_new') +</a>
                </div>
                <form method="get" action="{{ route('dacha.index') }}" class="filter">
                    <div class="filter__input">
                        <input placeholder="@lang('main.name')..." name="name" type="text"
                               @if(!empty(request()->get('name'))) value="{{ request()->get('name') }}"@endif >
                    </div>
                    <div class="filter__select">
                        <select name="category_id">
                            <option value="0">Все</option>
                            @foreach($categories as $category)
                                <option
                                    @if(!empty(request()->get('category_id')) and request()->get('category_id') == $category->id) selected
                                    @endif
                                    value="{{ $category->id }}">
                                    {{ $category->name_ru }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter__select">
                        <select name="top_rated">
                            <option>Все</option>
                            <option
                                @if(!empty(request()->get('top_rated')) and request()->get('top_rated') == 1) selected
                                @endif value="1">
                                Топ дачи
                            </option>
                        </select>
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
                        <td>@lang('main.location')</td>
                        <td>@lang('main.actions')</td>
                        <td>@lang('main.created_date')</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dacha as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name_ru }}</td>
                            <td class="imageColumn">
                                <div class="imgBx">
                                    @if(!empty($item->images[0]->image_path))
                                        <img src="/{{ $item->images[0]->image_path }}">
                                    @else
                                        <img src="/assets/img/default.png">
                                    @endif
                                </div>
                            </td>

                            <td>
                                @if(!empty($item->category->name_ru))
                                    {{ $item->category->name_ru }}
                                @else
                                    not found
                                @endif
                            </td>

                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('dacha.edit', $item->id) }}">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
                                <a onclick="openModal({{ $item->id }})">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                        <!-- Modal content -->
                        <div id="modal_container{{ $item->id }}" class="modal-container">
                            <div class="modal">
                                <div class="modal__header">
                                    <h2>@lang('main.confirm_action')</h2>
                                    <a class="modal__close" href="#" onclick="closeModal({{ $item->id }})"
                                       id="close{{ $item->id }}">
                                        <ion-icon name="close-outline"></ion-icon>
                                    </a>
                                </div>
                                <form method="post" action="{{ route('dacha.destroy', $item->id) }}"
                                      class="modal__form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete">
                                        <button class="modal__delete" type="submit">
                                            @lang('main.delete')
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('admin.templates.paginate', ['items' => $dacha])
        </div>
    </div>
@endsection

@section('js')
    <script>
        function openModal(id) {
            let modal_container = document.getElementById('modal_container' + id);
            modal_container.classList.add('show')
        }

        function closeModal(id) {
            let modal_container = document.getElementById('modal_container' + id);
            modal_container.classList.remove('show')
        }
    </script>
@endsection
