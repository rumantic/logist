<?php

namespace App\Http\Livewire\Components\Company;

use App\Form\Types;

class CompanyForm
{
    public function get()
    {
        $form = [
            'name' => [
                'title' => __('Название'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'required'],
            ],
            'fullName' => [
                'title' => __('Полное название'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'directorName' => [
                'title' => __('ФИО директора'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'email' => [
                'title' => __('Email'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'required'],
            ],
            'phones' => [
                'title' => __('Телефоны'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'website' => [
                'title' => __('Web'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'address' => [
                'title' => __('Почтовый адрес'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'required'],
            ],
            'legalAddress' => [
                'title' => __('Юридический адрес'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'required'],
            ],
            'inn' => [
                'title' => __('ИНН'),
                'type' => Types::$INPUT,
                'validate' => ['integer', 'required'],
            ],
            'kpp' => [
                'title' => __('КПП'),
                'type' => Types::$INPUT,
                'validate' => ['integer', 'nullable'],
            ],
            'OGRN' => [
                'title' => __('ОГРН'),
                'type' => Types::$INPUT,
                'validate' => ['integer', 'nullable'],
            ],
            'description' => [
                'title' => __('Описание'),
                'type' => Types::$TEXTAREA,
                'validate' => ['string', 'nullable'],
            ],
            'code' => [
                'title' => __('Код'),
                'type' => Types::$INPUT,
                'validate' => ['string', 'nullable'],
            ],
            'active' => [
                'title' => __('Активна'),
                'type' => Types::$CHECKBOX,
                'validate' => ['boolean'],
            ],
            'calcTransact' => [
                'title' => __('calcTransact'),
                'type' => Types::$CHECKBOX,
                'validate' => ['boolean'],
            ],
            'loadPayment' => [
                'title' => __('loadPayment'),
                'type' => Types::$CHECKBOX,
                'validate' => ['boolean'],
            ],
        ];
        return $form;
    }
}