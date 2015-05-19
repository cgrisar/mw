<?php namespace App\Movingwine;

use Illuminate\Database\Eloquent\Model;

class TmpAddress extends Model {

	//

    protected $fillable = ['id', 'address', 'zip', 'county', 'country', 'phone', 'email', 'contact'];
    protected $table = "tmpAddresses";

}
