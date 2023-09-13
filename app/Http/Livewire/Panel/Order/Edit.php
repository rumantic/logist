<?php

namespace App\Http\Livewire\Panel\Order;

use App\Models\Category;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $description;
    public $station_start;
    public $station_end;
    public Order $order;

    public function mount($id)
    {
        $this->order = Order::where('id', $id)->first();
        $this->station_start = $this->order->station_start;
        $this->station_end = $this->order->station_end;
        $this->description = $this->order->description;
    }

    public function edit()
    {
        if(!auth()->user()->can('admin_order_edit')) {
            return abort(403);
        }

        $this->validate([
            'station_start' => ['string', 'required'],
            'station_end' => ['string', 'required'],
            'description' => 'nullable',
        ]);

        $order = $this->order;

        $order->station_start = $this->station_start;
        $order->station_end = $this->station_end;
        $order->description = $this->description;
        $order->save();

        $this->emit('refreshDatatable');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }

    public function render()
    {
        $form = new OrderForm();
        $form_shape = $form->get();
        return view('livewire.panel.order.edit', compact('form_shape'));
    }
}