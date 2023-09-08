<?php
namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OrderFilter extends ModelFilter
{
    public function search($query)
    {
        return $this->orWhere('station_start', 'LIKE', '%' . $query . '%')
            ->orWhere('station_end', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%');
    }
}
