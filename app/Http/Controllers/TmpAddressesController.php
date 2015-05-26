<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movingwine\Datatable;
use App\Movingwine\TmpAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TmpAddressesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$addresses = Datatable::output(TmpAddress::all(), ['key'=> 'id', 'newkey' => 'Dt_Rowid', 'transform' => 'row_']);
		return ['draw' => '1', 'RecordCount' => $addresses->count(), 'data' => $addresses];
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\AddressRequest $request)
	{
		//
		TmpAddress::create($request->all());
		return '{"success": true}';
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		//
		return TmpAddress::find(Input::get('id'))->toJson();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\AddressRequest $request)
	{
		//
		$tmpAddress = TmpAddress::find(Input::get('id'));
		$tmpAddress->address = Input::get('address');
		$tmpAddress->zip = Input::get('zip');
		$tmpAddress->county = Input::get('county');
		$tmpAddress->country = Input::get('country');
		$tmpAddress->phone = Input::get('phone');
		$tmpAddress->email = Input::get('email');
		$tmpAddress->contact = Input::get('contact');
		$tmpAddress->save();
		return '{"success": true}';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		//
		TmpAddress::find(Input::get('id'))->delete();
		return '{"success": true}';
	}

}
