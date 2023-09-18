<?php

namespace App\Http\Livewire\Components\UI;

class SelectModel extends Select
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
