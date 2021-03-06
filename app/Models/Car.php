<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

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

    //Defining a has many through relationship
    public function engine()
    {
        return $this->hasMany(
            Engine::class,
            CarModel::class,
            'car_id', //Foreign key on carModel table
            'model_id' //Foreign key on engine table
        );
    }

    //Define a has one through relationship

    public function productionDate()
    {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id',
            'model_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
