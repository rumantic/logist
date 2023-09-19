@php
    $min_date = date('m/d/Y', strtotime(date('Y-m-d'). ' + 3 days'));
@endphp
<label class="form-label" for="{{$model_name}}">{{ $title }}</label>
<input type="text" value="{{$date_start_value}} - {{$date_end_value}}" class="form-control @error($model_name) is-invalid @enderror" name="{{$model_name}}" placeholder="{{ $title }}" />
<input type="hidden" name="{{$date_start_model}}" wire:model="{{$date_start_model}}" id="{{$date_start_model}}" value="{{ ${'date_start_model'} }}">
<input type="hidden" name="{{$date_end_model}}" wire:model="{{$date_end_model}}" id="{{$date_end_model}}" value="{{ ${'date_end_model'} }}">
@error($model_name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror

<script>
    $(function() {
        $('input[name="{{$model_name}}"]').daterangepicker({
            opens: 'left',
            minDate: '{{$min_date}}',
            autoApply: true,
            "locale": {
                "format": "MM/DD/YYYY",
                "separator": " - ",
                "applyLabel": "Применить",
                "cancelLabel": "Отмена",
                "fromLabel": "С",
                "toLabel": "До",
                "customRangeLabel": "Вручную",
                "weekLabel": "Н",
                "daysOfWeek": [
                    "Вс",
                    "Пн",
                    "Вт",
                    "Ср",
                    "Чт",
                    "Пт",
                    "Сб"
                ],
                "monthNames": [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
                "firstDay": 1
            },
        }, function(start, end, label) {
            @this.set('{{$date_start_model}}', start.format('YYYY-MM-DD'));
            @this.set('{{$date_end_model}}', end.format('YYYY-MM-DD'));
            $("#{{$date_start_model}}").val(start.format('YYYY-MM-DD'));
            $("#{{$date_end_model}}").val(end.format('YYYY-MM-DD'));
        });
    });
</script>
