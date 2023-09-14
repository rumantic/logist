<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use Filterable;
    const CREATED_AT = 'addTime';
    const UPDATED_AT = 'updateTime';

    public $table = 'company';

}
