<?php

namespace App\Http\Livewire\Panel\Order;

use App\Models\Article;
use App\Models\Category;
use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $description;
    public $station_start;
    public $station_end;

    protected $listeners = [
        'updateList' => 'render'
    ];

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
        $categories = Category::where('type', 'article')->get();
        return view('livewire.panel.order.create', compact('categories'));
    }
}
