<?php

namespace App\Http\Livewire\Components\Company;

use App\Http\Livewire\Components\UI\SimpleSelect;
use App\Models\CompanyType;

class SelectType extends SimpleSelect
{
    public $typeId;

    public function options($searchTerm = null) : \Illuminate\Support\Collection
    {
        $items = CompanyType::all();
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
}
