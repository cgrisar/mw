<?php
/**
 * Created by PhpStorm.
 * User: charlesgrisar
 * Date: 25/03/15
 * Time: 00:31

 This class contains helper functions to be used in movingWine
 */

namespace App\Movingwine;


class Datatable {

    /**
     * @param $data
     * @param array $transform
     * @return mixed
     *
     * A function to rewrite the output array if need be, transforming a key into a new key and transforming the output
     *
     */
    public static function output($data, $transform = ['key' => 'id', 'newkey' => 'DT_RowId', 'transform' => ''])
    {
        foreach ($data as $datarow)
        {
            if(isset($datarow[$transform['key']]))
            {
                $datarow[$transform['newkey']] = $transform['transform'] . $datarow[$transform['key']];
                unset($datarow[$transform['key']]);
            }
        }

        return $data;
    }
}