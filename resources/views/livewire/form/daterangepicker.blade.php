<label class="form-label" for="{{$model_name}}">{{ $title }}</label>
<input type="text" value="{{date('m/d/Y')}} - {{date('m/d/Y')}}" class="form-control @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}" />
@error($model_name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
