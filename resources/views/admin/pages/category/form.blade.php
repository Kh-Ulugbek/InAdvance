<div class="form__input">
    <label>
        @lang('main.name_uz')
    </label>
    @error('name_uz')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_uz" type="text" @if(!empty(old('name_uz'))) value="{{ old('name_uz') }}"
           @elseif(!empty($category->name_uz)) value="{{ $category->name_uz }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.name_ru')
    </label>
    @error('name_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_ru" type="text" @if(!empty(old('name_ru'))) value="{{ old('name_ru') }}"
           @elseif(!empty($category->name_ru)) value="{{ $category->name_ru }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.name_en')
    </label>
    @error('name_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_en" type="text" @if(!empty(old('name_en'))) value="{{ old('name_en') }}"
           @elseif(!empty($category->name_en)) value="{{ $category->name_en }}" @endif >
</div>

<div class="form__input">
    <label for="description_uz">
        @lang('main.description_uz')
    </label>
    @error('description_uz')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_uz" name="description_uz" rows="8" cols="80">@if(!empty(old('description_uz'))){{ old('description_uz') }}@elseif(!empty($category->description_uz)){{ $category->description_uz }}@endif</textarea>
</div>

<div class="form__input">
    <label for="description_ru">
        @lang('main.description_ru')
    </label>
    @error('description_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_ru" name="description_ru" rows="8" cols="80">@if(!empty(old('description_ru'))){{ old('description_ru') }}@elseif(!empty($category->description_ru)){{ $category->description_ru }}@endif</textarea>
</div>

<div class="form__input">
    <label for="description_ru">
        @lang('main.description_en')
    </label>
    @error('description_en')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <textarea id="description_en" name="description_en" rows="8" cols="80">@if(!empty(old('description_en'))){{ old('description_en') }}@elseif(!empty($category->description_en)){{ $category->description_en }}@endif</textarea>
</div>

<div class="upload">
    @error('image_path')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <div class="uploadImage">
        <img id="output" @if(!empty($category->image_path)) src="{{ $category->image_path }}" @else src="/assets/img/default.png" @endif>
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
