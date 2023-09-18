<label class="form-label" for="{{$model_name}}">{{ $title }}</label>
<select wire:model.defer="{{$model_name}}" class="form-control @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}">
    <option value="0">не выбрано</option>
    @foreach( $form_options[$model_name] as $item )
        <option value="{{$item['value']}}" wire:key="opt-{{ $item['value'] }}">{{$item['description']}}</option>
    @endforeach
</select>
@error($model_name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
