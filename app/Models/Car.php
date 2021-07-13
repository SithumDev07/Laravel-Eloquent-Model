<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description'];

    protected $hidden = ['updated_at'];

    protected $visible = ['name', 'founded', 'description'];

    // protected $timestamps = true;

    //Date Format
    // protected $dateFormat = 'h:m:s';
}
