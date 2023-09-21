<?php

namespace App\Http\Livewire\Components;

use Sitebill\Types\Form\Inputs as Types;
use Livewire\Component;

class BaseComponent extends Component
{
    protected $form_shape;
    protected $form_options = [];

    protected function initClassAttributes ( $form_shape, $model = null ): void
    {
        foreach ( $form_shape as $key => $item ) {
            if ( !isset($item['store']) or $item['store']  ) {
                if ( !is_null($model) and isset($model->{$key}) ) {
                    $this->{$key} = $model->{$key};
                } else {
                    $this->{$key} = null;
                }
            }
            $this->initRelatedModels($key, $item, $model);
        }
    }

    protected function initRelatedModels ( $key, $item, $model )
    {
        switch ( $item['type'] )
        {
            case Types::$DATE_RANGE:
                if ( !is_null($model) and isset($model->{$item['date_start_model']}) ) {
                    $this->{$item['date_start_model']} = $model->{$item['date_start_model']};
                } else {
                    $this->{$item['date_start_model']} = null;
                }

                if ( !is_null($model) and isset($model->{$item['date_end_model']}) ) {
                    $this->{$item['date_end_model']} = $model->{$item['date_end_model']};
                } else {
                    $this->{$item['date_end_model']} = null;
                }
                break;
            case Types::$SELECT:
                if ( isset($item['options']) ) {
                    $this->form_options[$key] = $item['options'];
                } else {
                    $this->form_options[$key] = $this->initSelectOptions($item, $model);
                }

                if ( isset($item['autocomplete']) and $item['autocomplete'] ) {
                    $this->{$key.'_autocomplete'} = '';
                    if ( isset($model) ) {
                        $this->{$key.'_autocomplete'} = $model->{$key.'_relation'}->name;
                    }
                }

                break;
            default:
        }
    }

    protected function initSelectOptions ( $item, $model, $search_key = null, $term = null )
    {

        if ( $search_key ) {
            $get_records = $item['hasOne']::where($search_key, 'like', '%'.$term.'%');
        } else {
            $get_records = $item['hasOne']::where('id', '>', 0);
        }
        if ( isset($item['order']) ) {
            $get_records->orderBy($item['order']);
        }
        $items = $get_records->limit(10)->get();

        $result = [];

        if ( $items ) {
            foreach ( $items as $f_item ) {
                $result[] = [
                    'value' => $f_item->id,
                    'description'=> $f_item->name
                ];
            }
        }
        return collect($result);
    }

    protected function initModelValues ( $form_shape, $model )
    {
        foreach ( $form_shape as $key => $item ) {
            switch ( $item['type'] ) {
                case Types::$DATE_RANGE:
                    $start_date = $item['date_start_model'];
                    if ( isset($this->{$start_date}) ) {
                        $model->{$start_date} = $this->{$start_date};
                    }
                    $end_date = $item['date_end_model'];
                    if ( isset($this->{$end_date}) ) {
                        $model->{$end_date} = $this->{$end_date};
                    }
                    break;

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
                    if ( isset($this->{$key}) ) {
                        $model->{$key} = $this->{$key};
                    }
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
            if ( !isset($item['store']) or $item['store']  ) {
                $result[$key] = $item['validate'];
            }
        }
        return $result;
    }
}
