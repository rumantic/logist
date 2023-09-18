<?php

namespace App\Http\Livewire\Components;

use App\Form\Types;
use Livewire\Component;

class BaseComponent extends Component
{
    protected $form_shape;

    protected function initClassAttributes ( $form_shape, $model = null ): void
    {
        foreach ( $form_shape as $key => $item ) {
            if ( !is_null($model) and isset($model->{$key}) ) {
                $this->{$key} = $model->{$key};
            } else {
                $this->{$key} = null;
            }
        }
    }

    protected function initModelValues ( $form_shape, $model )
    {
        foreach ( $form_shape as $key => $item ) {
            switch ( $item['type'] ) {
                case Types::$CHECKBOX:
                    if ( empty($this->{$key}) ) {
                        $model->{$key} = 0;
                    }
                    break;
                case Types::$TEXTAREA:
                case Types::$INPUT:
                    $model->{$key} = $this->getInputValue($key, $this->{$key});
                    break;
                default:
                    $model->{$key} = $this->{$key};
            }
        }
        return $model;
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
