<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Company;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Companies extends Component
{
    use LivewireAlert;
    public $user;
    public $company;
    public $search = "";
    protected $updatesQueryString = ['search'];

    protected $listeners = [
        'confirmedDeleteCompany',
        'cancelledDeleteCompany',
        'deleteSelectedQuery',
        'updateCompanyList' => 'render'
    ];

    public function mount(User $user)
    {
        if(!auth()->user()->can('admin_user_companies')) {
            return abort(403);
        }
        $this->user = $user;
    }

    public function deleteCompany(Company $company)
    {
        if(!auth()->user()->can('admin_user_companies')) {
            return abort(403);
        }
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteCompany',
            'onCancelled' => 'cancelledDeleteCompany'
        ]);
        $this->company = $company;
    }

    public function assign(Company $company)
    {
        if(!auth()->user()->can('admin_user_companies')) {
            return abort(403);
        }
        $this->user->companies()->syncWithoutDetaching($company->id);
        $this->emit('updateCompanyList');
        $this->alert(
            'success',
            __('bap.added')
        );
    }

    public function confirmedDeleteCompany()
    {
        if(!auth()->user()->can('admin_user_companies')) {
            return abort(403);
        }
        $this->user->companies()->detach($this->company->id);
        $this->emit('updateCompanyList');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function cancelledDeleteCompany()
    {
        $this->alert(
            'success',
            __('bap.cancelled')
        );
    }

    public function render()
    {
        if(!auth()->user()->can('admin_user_companies')) {
            return abort(403);
        }
        if($this->search != "") {
            $companies = Company::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('inn', 'like', '%'.$this->search.'%')
                ->get();
        } else {
            $companies = Company::take(100)->get();

        }
        return view('livewire.admin.user.companies', compact('companies'));
    }
}
