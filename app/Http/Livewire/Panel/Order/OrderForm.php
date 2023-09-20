<?php
namespace App\Http\Livewire\Panel\Order;

use App\Form\Types;
use App\Models\Company;
use App\Models\Stantion;

class OrderForm {
    public function get()
    {
        $form = [
            'daterange' => [
                'title' => __('Период перевозки'),
                'type' => Types::$DATE_RANGE,
                'store' => false,
                'date_start_model' => 'start_date',
                'date_end_model' => 'end_date',
                'validate' => ['string', 'nullable'],
            ],
            'transport_type' => [
                'title' => __('Вид перевозки'),
                'type' => Types::$SELECT,
                'options' => [
                    [
                        'value' => 1,
                        'description' => 'групповая',
                    ],
                    [
                        'value' => 2,
                        'description' => 'повагонная',
                    ],
                ],
                'validate' => ['integer', 'required'],
            ],
            'station_start' => [
                'name' => 'station_start',
                'title' => __('bap.station_start'),
                'type' => Types::$SELECT,
                'validate' => ['integer', 'required'],
                'hasOne' => Stantion::class,
                'autocomplete' => true,
                'order' => 'name',
            ],
            'station_end' => [
                'name' => 'station_end',
                'title' => __('bap.station_end'),
                'type' => Types::$SELECT,
                'validate' => ['integer', 'required'],
                'hasOne' => Stantion::class,
                'autocomplete' => true,
                'order' => 'name',
            ],
            'company_source' => [
                'name' => 'company_source',
                'title' => __('Грузоотправитель'),
                'type' => Types::$SELECT,
                'validate' => ['integer', 'required'],
                'hasOne' => Company::class,
                'autocomplete' => true,
                'order' => 'name',
            ],
            'company_destination' => [
                'name' => 'company_destination',
                'title' => __('Грузополучатель'),
                'type' => Types::$SELECT,
                'validate' => ['integer', 'required'],
                'hasOne' => Company::class,
                'autocomplete' => true,
                'order' => 'name',
            ],
            'ROD' => [
                'title' => __('Род подвижного состава, кол-во, номер вагона'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'TREB' => [
                'title' => __('Требования к подвижному составу'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'nullable'],
            ],
            'GRUZ' => [
                'title' => __('Груз'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'nullable'],
            ],
            'CODE' => [
                'title' => __('Код груза по ЕТСНГ'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'weight' => [
                'title' => __('Вес, тн.'),
                'type' => Types::$INPUT,
                'default' => 0,
                'validate' => ['integer', 'nullable'],
            ],
            'conditions' => [
                'title' => __('Особые условия'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'nullable'],
            ],
            'bid' => [
                'title' => __('Согласованная ставка'),
                'type' => Types::$INPUT,
                'default' => 0,
                'validate' => ['integer', 'nullable'],
            ],
            'payer_ru' => [
                'title' => __('Плательщик по РФ'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'payer_sng' => [
                'title' => __('Плательщик по СНГ порожнего ( при отправке на экспорт)'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
        ];
        return $form;
    }
}
