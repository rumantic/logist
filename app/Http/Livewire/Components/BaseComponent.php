<?php

namespace App\Http\Livewire\Components;

use App\Form\Types;
use Livewire\Component;

class BaseComponent extends Component
{
    protected $form_shape;
    protected $form_options = [];

    protected function initClassAttributes ( $form_shape, $model = null ): void
    {
        foreach ( $form_shape as $key => $item ) {
            if ( !is_null($model) and isset($model->{$key}) ) {
                $this->{$key} = $model->{$key};
            } else {
                $this->{$key} = null;
            }
            $this->initRelatedModels($key, $item);
        }
    }

    protected function initRelatedModels ( $key, $item )
    {
        switch ( $item['type'] )
        {
            case Types::$SELECT:
                $this->form_options[$key] = $this->initSelectOptions($item['hasOne']);
                break;
            default:
        }
    }

    protected function initSelectOptions ( $model )
    {
        $items = $model::all();
        $result = [];

        if ( $items ) {
            foreach ( $items as $item ) {
                $result[] = [
                    'value' => $item->id,
                    'description'=> $item->name
                ];
            }
        }
        return collect($result);
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
