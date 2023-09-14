<?php

namespace App\Http\Livewire\Components;

use App\Form\Types;
use Livewire\Component;

class BaseComponent extends Component
{
    protected $form_shape;

    protected function initClassAttributes ( $form_shape ): void
    {
        foreach ( $form_shape as $key => $item ) {
            $this->{$key} = null;
        }
    }

    protected function initModelValues ( $form_shape, $model ): void
    {
        foreach ( $form_shape as $key => $item ) {
            switch ( $item['type'] ) {
                case Types::$TEXTAREA:
                case Types::$INPUT:
                    $model->{$key} = $this->getInputValue($key, $this->{$key});
                    break;
                default:
                    $model->{$key} = $this->{$key};
            }
        }
    }

    private function getInputValue ( $key, $value )
    {
        return is_null($this->{$key}) ? '' : $this->{$key};
    }

    protected function getValidateRules ( $form_shape )
    {
        $result = [];
        foreach ( $form_shape as $key => $item ) {
            $result[$key] = $item['validate'];
        }
        return $result;
    }
}
