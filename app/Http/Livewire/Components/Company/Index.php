<?php

namespace App\Http\Livewire\Components\Company;

use App\Models\Company;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public Company $model;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function mount()
    {
        $this->model = new Company();
    }

    public function render()
    {
        if(!auth()->user()->can('company_index')) {
            return abort(403);
        }
        return view('livewire.components.company.index')->layout('layouts.panel');
    }
}
