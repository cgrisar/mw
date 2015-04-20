<?php namespace App\Movingwine;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model {

	//
    protected $fillable = ['name', 'excise', 'address', 'zip', 'county', 'country', 'tel', 'email', 'contact'];

    public function slots()
    {
        return $this->hasMany('App\Movingwine\Slot');
    }

}
