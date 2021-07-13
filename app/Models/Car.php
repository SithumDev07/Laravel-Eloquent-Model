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

    // protected $hidden = ['updated_at'];

    // protected $visible = ['name', 'founded', 'description'];

    // protected $timestamps = true;

    //Date Format
    // protected $dateFormat = 'h:m:s';

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }


    //When it is One to One relationship, we don't need to write a method iniside Headquarter class
    public function headquarter()
    {
        return $this->hasOne(Headquarter::class);
    }
}
