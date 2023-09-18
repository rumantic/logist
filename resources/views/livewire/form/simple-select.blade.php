<select wire:model.defer="{{$model_name}}" class="form-control @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}">
    <option value="0">не выбрано</option>
    @foreach( $options as $item )
        <option value="{{$item['value']}}" wire:key="opt-{{ $item['value'] }}">{{$item['description']}}</option>
    @endforeach
</select>
