<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;
    protected $table = 'api_keys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'key',
    ];
}
