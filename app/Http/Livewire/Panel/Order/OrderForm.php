<?php
namespace App\Http\Livewire\Panel\Order;

use App\Form\Types;

class OrderForm {
    public function get()
    {
        $form = [
            'daterange' => [
                'title' => __('Период перевозки'),
                'type' => Types::$DATE_RANGE,
            ],
            'station_start' => [
                'title' => __('bap.station_start'),
                'type' => Types::$INPUT,
            ],
            'station_end' => [
                'title' => __('bap.station_end'),
                'type' => Types::$INPUT,
            ],
            'description' => [
                'title' => __('bap.description'),
                'type' => Types::$TEXTAREA,
            ],
        ];
        return $form;
    }
}
