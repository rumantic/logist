<?php

namespace App\Http\Livewire\Components\Company;

use App\Models\Company;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = Company::class;
    public Company $item;
    protected $listeners = [
        'confirmedDeleteCompany',
        'cancelledDeleteCompany',
        'refreshDatatable' => 'render',
    ];


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setDefaultReorderSort('id', 'asc');
        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            return [
                'default' => true,
                'id' => $row->id,
                ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__('Название компании'), "name")
                ->sortable(),
            Column::make(__('Директор'), "directorName")
                ->sortable(),
            Column::make(__('Email'), "email")
                ->sortable(),
            Column::make(__('Телефоны'), "phones")
                ->sortable(),
            Column::make(__('Адрес'), "address")
                ->sortable(),
            Column::make(__('ИНН'), "inn")
                ->sortable(),
            Column::make(__('КПП'), "kpp")
                ->sortable(),
            Column::make(__('Описание'), "description")
                ->sortable(),
            Column::make(__('Код'), "code")
                ->sortable(),
            Column::make("actions", "id")
                ->format(function ($value, $row) {
                    return view('livewire.panel.order.actions')
                        ->with('id', $value)
                        ->with('order', $row);
                }),
        ];
    }

    public function delete($id)
    {
        if(!auth()->user()->can('company_delete')) {
            return abort(403);
        }

        $this->order = Order::where('id', $id)->first();

        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteCompany',
            'onCancelled' => 'cancelledDeleteCompany'
        ]);
    }

    public function confirmedDeleteOrder()
    {
        if(!auth()->user()->can('admin_order_delete')) {
            return abort(403);
        }
        $this->order->delete();
        $this->emit('refreshDatatable');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function cancelledDeleteOrder()
    {
        $this->alert(
            'success',
            __('bap.cancelled')
        );
    }

}
