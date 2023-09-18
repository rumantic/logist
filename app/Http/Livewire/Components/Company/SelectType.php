<?php

namespace App\Http\Livewire\Components\Company;

use App\Http\Livewire\Components\UI\Select;

class SelectType extends Select
{
    public function options($searchTerm = null) : \Illuminate\Support\Collection
    {
        return collect([
            [
                'value' => 'honda',
                'description' => 'Honda',
            ],
            [
                'value' => 'mazda',
                'description' => 'Mazda',
            ],
            [
                'value' => 'tesla',
                'description' => 'Tesla',
            ],
        ]);
    }
}
