<?php namespace App\Http\Requests;
/**
 * Created by PhpStorm.
 * User: charlesgrisar
 * Date: 1/03/15
 * Time: 23:14
 */

namespace App\Http\Requests;


class SlotRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'address'   => 'required|unique:slots,address',
            'excise'    => 'required',
            'capacity'  => 'required|numeric'
        ];
    }

}