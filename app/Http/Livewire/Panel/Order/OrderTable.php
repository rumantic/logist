<?php

namespace App\Http\Livewire\Panel\Order;

use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OrderTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = Order::class;
    public Order $order;
    protected $listeners = [
        'confirmedDeleteOrder',
        'cancelledDeleteOrder',
        'refreshDatatable' => 'render',
    ];


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setDefaultReorderSort('id', 'desc');
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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Дата начала", "start_date")
                ->format(function ($value) {
                    return date('d.m.Y', strtotime($value));
                })
                ->sortable(),
            Column::make("Дата завершения", "end_date")
                ->format(function ($value) {
                    return date('d.m.Y', strtotime($value));
                })
                ->sortable(),
            Column::make(__('bap.station_start'), "station_start.name")
                ->sortable(),

            Column::make(__('bap.station_end'), "station_end.name")
                ->sortable(),

            Column::make(__('Грузоотправитель'), "company_source.name")
                ->sortable(),
            Column::make(__('Грузополучатель'), "company_destination.name")
                ->sortable(),


            Column::make("Статус", "id")
                ->format(function ($value) {
                    return view('livewire.panel.order.fake')
                        ->with('title', 'в пути');
                }),
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
                ->format(function ($value, $row) {
                    return view('livewire.panel.order.actions')
                        ->with('id', $value)
                        ->with('order', $row);
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

    public function delete($id)
    {
        if(!auth()->user()->can('admin_order_delete')) {
            return abort(403);
        }

        $this->order = Order::where('id', $id)->first();

        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteOrder',
            'onCancelled' => 'cancelledDeleteOrder'
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
