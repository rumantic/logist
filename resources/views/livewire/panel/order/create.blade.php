@include('sitebill-livewire::form.modal', [
    'event' => 'create',
    'title' => __('bap.create_order'),
    'form_shape' => $form_shape,
    'action_title' => __('bap.create'),
])
