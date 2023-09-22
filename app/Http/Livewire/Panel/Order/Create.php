<?php

namespace App\Http\Livewire\Panel\Order;

use App\Http\Livewire\Panel\Order\Traits\AutocompleteTrait;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Sitebill\Livewire\App\Http\Components\BaseComponent;

class Create extends BaseComponent
{
    use LivewireAlert;
    use WithFileUploads;
    use AutocompleteTrait;

    public Order $model;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function __construct($id = null)
    {
        $this->model = new Order();

        $form = new OrderForm();
        $this->form_shape = $form->get();
        $this->initClassAttributes($this->form_shape);
        $this->start_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 3 days'));
        $this->end_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 days'));
        $this->weight = 0;
        $this->bid = 0;
        parent::__construct($id);
    }

    public function create()
    {
        if(!auth()->user()->can('admin_article_create')) {
            return abort(403);
        }

        $this->validate($this->getValidateRules($this->form_shape));

        $model = $this->model;
        $model = $this->initModelValues($this->form_shape, $model);

        $model->save();

        $this->emit('refreshDatatable');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        $form = new OrderForm();
        $form_shape = $form->get();
        $form_options = $this->form_options;

        return view('livewire.panel.order.create', compact('form_shape', 'form_options'));
    }
}
