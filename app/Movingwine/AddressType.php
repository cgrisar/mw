<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model {

	//

    public function addresses()
    {
        return $this->hasMany('App\Movingwine\Address');
    }

}
