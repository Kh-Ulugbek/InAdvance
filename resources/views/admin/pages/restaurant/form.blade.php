<div class="form__input">
    <label>
        @lang('main.name')
    </label>
    @error('name')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <input name="name" type="text" @if(!empty(old('name'))) value="{{ old('name') }}"
           @elseif(!empty($restaurant->name)) value="{{ $restaurant->name }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.restaurant_owner')
    </label>
    <input disabled type="text" value="{{ $restaurant->user->login }}">
</div>

<div class="form__input">
    <label>
        @lang('main.phone')
    </label>
    @error('phone')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <input name="phone" type="text" @if(!empty(old('phone'))) value="{{ old('phone') }}"
           @elseif(!empty($restaurant->phone)) value="{{ $restaurant->phone }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.open_time')
    </label>
    @error('open_time')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <input name="open_time" type="text" @if(!empty(old('open_time'))) value="{{ old('open_time') }}"
           @elseif(!empty($restaurant->open_time)) value="{{ $restaurant->open_time }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.close_time')
    </label>
    @error('close_time')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <input name="close_time" type="text" @if(!empty(old('close_time'))) value="{{ old('close_time') }}"
           @elseif(!empty($restaurant->close_time)) value="{{ $restaurant->close_time }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.bank_number')
    </label>
    @error('bank_number')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <input name="bank_number" type="text" @if(!empty(old('bank_number'))) value="{{ old('bank_number') }}"
           @elseif(!empty($restaurant->bank_number)) value="{{ $restaurant->bank_number }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.location') (@lang('main.map_ln'))
    </label>
    <input disabled value="{{ $restaurant->map_ln }}">
</div>

<div class="form__input">
    <label>
        @lang('main.location') (@lang('main.map_lt'))
    </label>
    <input disabled value="{{ $restaurant->map_lt }}">
</div>

<div class="upload">
    @error('image_path')
    <span class="validationError">{{ $message }}</span>
    @enderror
    <div class="uploadImage">
        <img id="output" @if(!empty($restaurant->image_path)) src="{{ $restaurant->image_path }}"
             @else src="/assets/img/default.png" @endif>
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
        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
