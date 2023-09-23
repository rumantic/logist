<?php

namespace App\Http\Livewire\Components\Company;

use App\Models\Company;
use App\Models\User;
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
        /*
        $user = User::where('id',1)->with('companies')->first();
        $company = Company::where('id',1316)->with('users')->first();
        $company->users()->sync([1,2,3,4]);
        $user->companies()->sync([1315]);
        $user->companies()->syncWithoutDetaching(1308);
        */

        if(!auth()->user()->can('company_index')) {
            return abort(403);
        }
        return view('livewire.components.company.index')->layout('sitebill-livewire::layouts.panel');
    }
}
