<?php namespace App\Movingwine;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	//

    protected $fillable = ['address', 'zip', 'county', 'country', 'phone', 'email', 'contact'];

    public function relationship()
    {
        return $this->belongsTo('App\Movingwine\Relationship');
    }

    public function addressType()
    {
        return $this->belongsTo('App\Movingwine\AddressType');
    }

}
