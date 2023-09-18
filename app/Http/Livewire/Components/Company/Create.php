<?php

namespace App\Http\Livewire\Components\Company;

use App\Http\Livewire\Components\BaseComponent;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Create extends BaseComponent
{
    use LivewireAlert;
    use WithFileUploads;
    protected $form_shape;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function __construct($id = null)
    {
        $form = new CompanyForm();
        $this->form_shape = $form->get();
        $this->initClassAttributes($this->form_shape);
        parent::__construct($id);
    }

    public function create()
    {
/*
        if(!auth()->user()->can('admin_article_create')) {
            return abort(403);
        }
*/
        $this->validate($this->getValidateRules($this->form_shape));

        $model = new Company();
        $model = $this->initModelValues($this->form_shape, $model);
        $model->save();
        $model->users()->syncWithoutDetaching(Auth::user()->id);

        $this->emit('refreshDatatable');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
        activity()->causedBy(Auth::user())->log('Добавлена новая компания '.$model->name);

    }

    public function render()
    {
        //dd($this->form_shape);
        //$form_shape = $this->form_shape;
        $form = new CompanyForm();
        $form_shape = $form->get();
        return view('livewire.components.company.create', compact('form_shape'));
    }
}
