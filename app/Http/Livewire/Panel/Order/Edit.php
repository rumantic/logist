<?php

namespace App\Http\Livewire\Panel\Order;

use App\Http\Livewire\Components\BaseComponent;
use App\Http\Livewire\Panel\Order\Traits\AutocompleteTrait;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends BaseComponent
{
    use LivewireAlert;
    use WithFileUploads;
    use AutocompleteTrait;
    public Order $model;

    public function __construct($id = null)
    {
        $form = new OrderForm();
        $this->form_shape = $form->get();
        $this->initClassAttributes($this->form_shape);
        parent::__construct($id);
    }


    public function mount($id)
    {
        $this->model = Order::where('id', $id)->first();
        $this->initClassAttributes($this->form_shape, $this->model);
    }

    public function edit()
    {
        if(!auth()->user()->can('admin_order_edit')) {
            return abort(403);
        }

        $this->validate($this->getValidateRules($this->form_shape));

        $model = $this->model;
        $model = $this->initModelValues($this->form_shape, $model);

        $model->save();

        $this->emit('refreshDatatable');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }

    public function render()
    {
        $form = new OrderForm();
        $form_shape = $form->get();
        $form_options = $this->form_options;

        return view('livewire.panel.order.edit', compact('form_shape', 'form_options'));
    }
}
