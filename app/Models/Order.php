<?php

namespace App\Models;

use App\Models\Duplicates\CompanyDuplicate;
use App\Models\Duplicates\StantionDuplicate;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use Filterable;


    public function station_start(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Stantion::class, 'station_start', 'id');
    }

    public function station_end(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StantionDuplicate::class, 'station_end', 'id');
    }


    public function destination_company(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Company::class, 'company_destination', 'id');
    }
    public function company_source(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CompanyDuplicate::class, 'company_source', 'id');
    }
}
