<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
            Column::make(__('bap.station_start'), "station_start")
                ->sortable(),
            Column::make(__('bap.station_end'), "station_end")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            Column::make("actions", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.actions')
                        ->with('id', $value);
                }),
/*
            ButtonGroupColumn::make('Actions')
                ->unclickable()
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('My Link 1')
                        ->title(fn ($row) => 'Link 1')
                        ->location(fn ($row) => 'https://'.$row->id.'google2.com')
                        ->view('livewire.panel.order.actions'),
                    LinkColumn::make('My Link 2')
                        ->title(fn ($row) => 'Link 2')
                        ->location(fn ($row) => 'https://'.$row->id.'google2.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                    LinkColumn::make('My Link 3')
                        ->title(fn ($row) => 'Link 3')
                        ->location(fn ($row) => 'https://'.$row->id.'google3.com')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'underline text-blue-500',
                            ];
                        }),
                ]),*/
        ];
    }
}
