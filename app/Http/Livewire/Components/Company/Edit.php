<?php

namespace App\Http\Livewire\Components\Company;

use Sitebill\Livewire\App\Http\Components\BaseComponent;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends BaseComponent
{
    use LivewireAlert;
    use WithFileUploads;
    public Company $model;

    public function __construct($id = null)
    {
        $form = new CompanyForm();
        $this->form_shape = $form->get();
        $this->initClassAttributes($this->form_shape);
        parent::__construct($id);
    }

    public function mount($id)
    {
        $form = new CompanyForm();
        $this->form_shape = $form->get();

        $this->model = Company::where('id', $id)->first();
        $this->initClassAttributes($this->form_shape, $this->model);
    }

    public function edit()
    {
/*
        if(!auth()->user()->can('admin_order_edit')) {
            return abort(403);
        }*/

        $this->validate($this->getValidateRules($this->form_shape));

        $model = $this->model;

        $model = $this->initModelValues($this->form_shape, $model);
        $model->save();

        $this->emit('refreshDatatable');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
        activity()->causedBy(Auth::user())->log('Редактирование профиля компании ('.$model->name.')');

    }



    public function render()
    {
        $form = new CompanyForm();
        $form_shape = $form->get();
        $form_options = $this->form_options;

        return view('livewire.components.company.edit', compact('form_shape', 'form_options'));
    }
}
