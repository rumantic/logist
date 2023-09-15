<label class="form-label" for="{{$model_name}}">{{ $title }}</label>
<input type="checkbox" wire:model="{{$model_name}}" class="form-check-input @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}">
@error($model_name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
