<?php

namespace App\Http\Livewire\Components\ActivityLog;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ActivityLogTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = ActivityLog::class;
    public ActivityLog $item;


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

        $this->setTableAttributes([
            'class' => 'table-hover',
        ]);
    }

    public function builder(): Builder
    {
        return ActivityLog::query()->with('causer');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make(__('Действия'), "description")
                ->sortable(),
            Column::make(__('Пользователь'), "causer.email")
                ->sortable(),
            Column::make(__('Дата'), "created_at")
                ->sortable(),
/*
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
                    return view('livewire.components.company.actions')
                        ->with('id', $value)
                        ->with('model', $row);
                }),
*/
        ];
    }
}
