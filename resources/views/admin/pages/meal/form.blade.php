<div class="form__input">
    <label for="select1">
        @lang('main.category')
    </label>
    @error('category_id')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <select id="select1" name="category_id">
        @foreach($categories as $category)
            <option @if(!empty($meal->category_id) and $meal->category_id == $category->id) selected
                    @endif value="{{ $category->id }}">{{ $category->name_ru }}</option>
        @endforeach
    </select>
</div>

<div class="form__input">
    <label>
        @lang('main.restaurant')
    </label>
    @error('restaurant_id')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <select name="restaurant_id">
        @foreach($restaurants as $restaurant)
            <option @if(!empty($meal->restaurant_id) and $meal->restaurant_id == $restaurant->id) selected
                    @endif value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
        @endforeach
    </select>
</div>

<div class="form__input">
    <label>
        @lang('main.name_uz')
    </label>
    @error('name_uz')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_uz" type="text" @if(!empty(old('name_uz'))) value="{{ old('name_uz') }}"
           @elseif(!empty($meal->name_uz)) value="{{ $meal->name_uz }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.name_ru')
    </label>
    @error('name_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_ru" type="text" @if(!empty(old('name_ru'))) value="{{ old('name_ru') }}"
           @elseif(!empty($meal->name_ru)) value="{{ $meal->name_ru }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.name_en')
    </label>
    @error('name_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_en" type="text" @if(!empty(old('name_en'))) value="{{ old('name_en') }}"
           @elseif(!empty($meal->name_en)) value="{{ $meal->name_en }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.price')
    </label>
    @error('price')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="price" type="text" data-mask="0000000000000000" @if(!empty(old('price'))) value="{{ old('price') }}"
           @elseif(!empty($meal->price)) value="{{ $meal->price }}" @endif >
</div>

<div class="form__input">
    <label for="description_uz">
        @lang('main.description_uz')
    </label>
    @error('description_uz')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_uz" name="description_uz" rows="8" cols="80">@if(!empty(old('description_uz'))){{ old('description_uz') }}@elseif(!empty($meal->description_uz)){{ $meal->description_uz }}@endif</textarea>
</div>

<div class="form__input">
    <label for="description_ru">
        @lang('main.description_ru')
    </label>
    @error('description_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_ru" name="description_ru" rows="8" cols="80">@if(!empty(old('description_ru'))){{ old('description_ru') }}@elseif(!empty($meal->description_ru)){{ $meal->description_ru }}@endif</textarea>
</div>

<div class="form__input">
    <label for="description_ru">
        @lang('main.description_en')
    </label>
    @error('description_en')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_en" name="description_en" rows="8" cols="80">@if(!empty(old('description_en'))){{ old('description_en') }}@elseif(!empty($meal->description_en)){{ $meal->description_en }}@endif</textarea>
</div>

<div class="upload">
    @error('image_path')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <div class="uploadImage">
        <img id="output" @if(!empty($meal->image_path)) src="{{ $meal->image_path }}" @else src="/assets/img/default.png" @endif>
    </div>
    <div class="form__input fileInput">
        <label for="fileInput">
            <ion-icon name="arrow-down-outline"></ion-icon>
            <span>@lang('main.upload')</span>
        </label>
        <input id="fileInput" name="image_path" type="file" onchange="loadFile(event)">
    </div>
    <div class="form__btn">
        <button type="submit">@lang('main.save')</button>
    </div>
</div>

@section('js')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
