@include('livewire.form.modal', [
    'event' => 'edit',
    'title' => __('bap.edit_order'),
    'form_shape' => $form_shape,
    'action_title' => __('bap.edit'),
])
