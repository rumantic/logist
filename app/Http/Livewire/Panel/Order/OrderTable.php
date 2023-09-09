<?php

namespace App\Http\Livewire\Panel\Order;

use App\Models\Order;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrderTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultReorderSort('id', 'desc');
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
            Column::make("Номер вагона", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', 123);
                }),
            Column::make("Дата отправления вагона", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', '20.09.2023');
                }),
            Column::make("Статус", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', 'в пути');
                }),
            Column::make(__('bap.station_start'), "station_start")
                ->sortable(),
            Column::make(__('bap.station_end'), "station_end")
                ->sortable(),
            Column::make("Статус операции", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', 'ожидает оплаты');
                }),
            Column::make("Цена перевозки", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', '2 500 000');
                }),
            Column::make("Оплата", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', '500 000');
                }),
            Column::make("Наличие простоя", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', 'нет');
                }),
            /*
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            */
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
