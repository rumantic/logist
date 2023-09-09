@foreach( $form_shape as $key => $item )
    <div class="mb-3">
        @switch( $item['type'] )
            @case(App\Form\Types::$TEXTAREA)
                @include('livewire.form.textarea',
                    [
                        'model_name' => $key,
                        'title' => $item['title'],
                        'message' => $message ?? null
                    ])
                @break
            @default
                @include('livewire.form.input',
                    [
                        'model_name' => $key,
                        'title' => $item['title'],
                        'message' => $message ?? null
                    ])
        @endswitch
    </div>
@endforeach
