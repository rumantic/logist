@include('livewire.form.modal', [
    'event' => 'create',
    'title' => __('Новая компания'),
    'form_shape' => $form_shape,
    'action_title' => __('bap.create'),
])
