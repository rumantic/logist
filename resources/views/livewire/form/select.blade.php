<label class="form-label" for="{{$model_name}}">{{ $title }}</label>
@if($autocomplete)
    <autocomplete-area
        x-data='{
        {{$model_name}}Selected(e) {
            let value = e.target.value
            let id = document.body.querySelector("datalist [value=\""+value+"\"]").dataset.value
            $wire.set("{{$model_name}}", id)
        }
    }'
    >

        <input
            type="text"
            list="{{$model_name}}Options"
            wire:model="{{$model_name.'_autocomplete'}}"
            class="form-control @error($model_name) is-invalid @enderror"
            x-on:change.debounce="{{$model_name}}Selected($event)"
        >
        <input type="hidden" name="{{$model_name}}" wire:model="{{$model_name}}">

        <datalist id="{{$model_name}}Options">
            @foreach($form_options[$model_name] as $item)
                <option
                    wire:key="{{ $model_name.$item['value'] }}"
                    data-value="{{ $item['value'] }}"
                    value="{{ $item['description'] }}"
                ></option>
            @endforeach
        </datalist>
    </autocomplete-area>
@else
    <select wire:model.defer="{{$model_name}}" class="form-control @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}">
        <option value="0">не выбрано</option>
        @foreach( $form_options[$model_name] as $item )
            <option value="{{$item['value']}}" wire:key="opt-{{ $item['value'] }}">{{$item['description']}}</option>
        @endforeach
    </select>
@endif
@error($model_name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
