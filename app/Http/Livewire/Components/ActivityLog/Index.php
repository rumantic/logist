<?php

namespace App\Http\Livewire\Components\ActivityLog;

use App\Models\ActivityLog;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    //public ActivityLog $model;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function mount()
    {
        //$this->model = new ActivityLog();
    }

    public function render()
    {
        if(!auth()->user()->can('company_index')) {
            return abort(403);
        }
        return view('livewire.components.activitylog.index')->layout('sitebill-livewire::layouts.panel');
    }
}
