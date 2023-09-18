<?php

namespace App\Http\Livewire\Panel\Order;

use App\Http\Livewire\Components\BaseComponent;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Create extends BaseComponent
{
    use LivewireAlert;
    use WithFileUploads;
    public $description;
    public $station_start;
    public $station_end;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function __construct($id = null)
    {
        $form = new OrderForm();
        $this->form_shape = $form->get();
        $this->initClassAttributes($this->form_shape);
        parent::__construct($id);
    }

    public function create()
    {
        if(!auth()->user()->can('admin_article_create')) {
            return abort(403);
        }

        $this->validate([
            'station_start' => ['string', 'required'],
            'station_end' => ['string', 'required'],
            'description' => 'nullable',
        ]);

        $order = new Order();
        $order->station_start = $this->station_start;
        $order->station_end = $this->station_end;
        $order->description = $this->description;
        $order->save();

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
