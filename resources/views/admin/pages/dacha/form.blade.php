<div class="form__input">
    <label for="select1">
        @lang('main.location')
    </label>
    @error('category_id')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <select id="select1" name="category_id">
        @foreach($categories as $category)
            <option @if(!empty($dacha->category_id) and $dacha->category_id == $category->id) selected
                    @endif value="{{ $category->id }}">{{ $category->name_ru }}</option>
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
           @elseif(!empty($dacha->name_uz)) value="{{ $dacha->name_uz }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.name_ru')
    </label>
    @error('name_ru')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="name_ru" type="text" @if(!empty(old('name_ru'))) value="{{ old('name_ru') }}"
           @elseif(!empty($dacha->name_ru)) value="{{ $dacha->name_ru }}" @endif >
</div>
<div class="form__input checkboxInput">
    @error('top_rated')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <label>
        @lang('main.top_rated')
    </label>
    <input type="checkbox" name="top_rated" class="form__checkbox" value="1"
           @if(!empty($dacha->top_rated) and $dacha->top_rated == "1") checked @endif>
</div>
<div class="form__input">
    <label>
        @lang('main.bathroom_count')
    </label>
    @error('bathroom_count')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="bathroom_count" type="text" data-mask="000"
           @if(!empty(old('bathroom_count'))) value="{{ old('bathroom_count') }}"
           @elseif(!empty($dacha->bathroom_count)) value="{{ $dacha->bathroom_count }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.capacity')
    </label>
    @error('capacity')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="capacity" type="text" data-mask="0000" @if(!empty(old('capacity'))) value="{{ old('capacity') }}"
           @elseif(!empty($dacha->capacity)) value="{{ $dacha->capacity }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.room_count')
    </label>
    @error('room_count')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="room_count" type="text" data-mask="000" @if(!empty(old('room_count'))) value="{{ old('room_count') }}"
           @elseif(!empty($dacha->room_count)) value="{{ $dacha->room_count }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.price')
    </label>
    @error('cost')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="cost" type="text" data-mask="0000000000000000" @if(!empty(old('cost'))) value="{{ old('cost') }}"
           @elseif(!empty($dacha->cost)) value="{{ $dacha->cost }}" @endif >
</div>

<div class="form__input">
    <label>
        @lang('main.phone') (998901234567)
    </label>
    @error('phone')
    <span class="validationError">{{ $message  }}</span>
    @enderror
    <input name="phone" type="text" data-mask="000000000000" @if(!empty(old('phone'))) value="{{ old('phone') }}"
           @elseif(!empty($dacha->phone)) value="{{ $dacha->phone }}" @endif >
</div>
@foreach($comforts as $comfort)
    <div class="form__input checkboxInput">
        <label>
            {{ $comfort->name_ru }}
        </label>
        <input type="checkbox" @if(!empty($dacha) and $dacha->comforts->where('id', $comfort->id)->count()) checked @endif
               name="comforts[]" class="form__checkbox" value="{{$comfort->id}}">
    </div>
@endforeach
{{--@if(!empty($dacha->comforts_ru))--}}
{{--    <div id="multipleInput" class="multipleInput">--}}
{{--        @foreach($dacha->comforts_uz as $comfort)--}}
{{--            <div id="comports{{ $loop->index }}" class="form__input">--}}
{{--                <label>--}}
{{--                    @lang('main.comforts')--}}
{{--                </label>--}}
{{--                <input placeholder="@lang('main.uz')" value="{{ $comfort }}" name="comforts_uz[]" type="text">--}}
{{--                <input placeholder="@lang('main.ru')" value="{{ $dacha->comforts_ru[$loop->index] }}"--}}
{{--                       name="comforts_ru[]"--}}
{{--                       type="text">--}}
{{--                @if (!$loop->first)--}}
{{--                    <button type="button" onclick="removeInput('s'+{{ $loop->index }})"--}}
{{--                            class="removeButton inputRemove">--}}
{{--                        <ion-icon name="close-outline"></ion-icon>--}}
{{--                    </button>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@else--}}
{{--    <div id="multipleInput" class="multipleInput">--}}
{{--        <div class="form__input">--}}
{{--            <label>--}}
{{--                @lang('main.comforts')--}}
{{--            </label>--}}
{{--            @error('comforts_uz')--}}
{{--            <span class="validationError">{{ $message  }}</span>--}}
{{--            @enderror--}}
{{--            <input placeholder="uz" name="comforts_uz[]" type="text" value="{{ old('comforts') }}">--}}
{{--            <input placeholder="ru" name="comforts_ru[]" type="text" value="{{ old('comforts') }}">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
@if(!empty($dacha->images))
    <div id="reqs">
        @foreach($dacha->images as $images)
            <div id="uploads{{ $loop->index }}">
                <input name="exist_image[]" type="hidden" value="{{ $images->id }}">
                <div class="uploadImage">
                    <img id="outputs{{ $loop->index }}"
                         @if(!empty($images->image_path)) src="/{{ $images->image_path }}"
                         @else src="/assets/img/default.png" @endif>
                </div>
                <div class="form__input fileInput">
                    <label for="fileInputs{{ $loop->index }}">
                        <ion-icon name="arrow-down-outline"></ion-icon>
                        <span>@lang('main.upload')</span>
                    </label>
                    <input id="fileInputs{{ $loop->index }}" onchange="uploadImg('s'+{{ $loop->index  }})"
                           name="exist_image_path[{{ $images->id }}]" type="file">
                    @if (!$loop->first)
                        <button type="button" onclick="removeElement('s'+{{ $loop->index }})" class="removeButton">
                            <ion-icon name="close-outline"></ion-icon>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div id="reqs">
        <div id="upload" class="upload">
{{--            @dd($errors)--}}
            @error('image_path')
            <span class="validationError">{{ $message  }}</span>
            @enderror
            <div class="uploadImage">
                <img id="output0" src="/assets/img/default.png">
            </div>

            <div class="form__input fileInput">
                <label for="fileInput0">
                    <ion-icon name="arrow-down-outline"></ion-icon>
                    <span>@lang('main.upload')</span>
                </label>
                <input onchange="uploadImg(0)" id="fileInput0" name="image_path[]" type="file">
            </div>
        </div>
    </div>
@endif
<button class="addButton" type="button" onclick="add()">
    <ion-icon name="add-outline"></ion-icon>
</button>

<div class="form__btn">
    <button type="submit">@lang('main.save')</button>
</div>

@section('js')
    <script>
        var reqs_id = 0;
        var addCount = 0;

        function addInput() {
            addCount++;
            var element = `<div id="comport` + addCount + `" class="form__input">
                                <label>
                                    {{ __('main.comforts') }}
            </label>
            <input placeholder="{{ __('main.uz') }}" name="comforts_uz[]" type="text">
                                <input placeholder="{{ __('main.ru') }}" name="comforts_ru[]" type="text">
                                <button type="button" onclick="removeInput(` + addCount + `)" class="removeButton inputRemove">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                            </div>`

            $("#multipleInput").append(element)
        }

        function removeInput(id) {
            console.log("#comport" + id)
            $("#comport" + id).remove();
        }

        function uploadImg(id) {
            var file = $("#fileInput" + id).get(0).files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function () {
                    $("#output" + id).attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function removeElement(id) {
            $("#upload" + id).remove();
        }

        function add() {
            reqs_id++; // increment reqs_id to get a unique ID for the new element

            //create textbox
            var input = `<div id="upload` + reqs_id + `">
            <div class="uploadImage">
                <img id="output` + reqs_id + `" src="/assets/img/default.png">
            </div>

            <div class="form__input fileInput">
                <label for="fileInput` + reqs_id + `">
                    <ion-icon name="arrow-down-outline"></ion-icon>
        <span>{{__("main.upload")}}</span>
                </label>
                <input onchange="uploadImg(` + reqs_id + `)" id="fileInput` + reqs_id + `" name="image_path[]" type="file">
                <button type="button" onclick="removeElement(` + reqs_id + `)" class="removeButton"><ion-icon name="close-outline"></ion-icon></button>
            </div>
        </div>`;
            //append elements
            $("#reqs").append(input)

        }
    </script>
@endsection
