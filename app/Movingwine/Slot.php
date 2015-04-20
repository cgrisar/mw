<?php namespace App\Movingwine;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model {

	//
    protected $fillable = ['address', 'excise', 'capacity'];

    public function warehouse()
    {
        return $this->belongsTo('App\Movingwine\Warehouse');
    }

    public function relationship()
    {
        return $this->belongsTo('App\Movingwine\Relationship');
    }

}
