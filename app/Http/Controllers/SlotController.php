<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movingwine\Slot;
use App\Movingwine\Warehouse;
use Illuminate\Http\Request;

class SlotController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param $warehouse_id
	 * @return Response
	 */
	public function create($warehouse_id, Requests\SlotRequest $request )
	{
		//
		$slot = new Slot($request->all());
		$slot->relationship_id = 1;				// make sure it is associated with MovingWine as a customer

		$warehouse = Warehouse::findOrFail($warehouse_id);

		$slot = $warehouse->slots()->save($slot);

		return redirect('warehouses/edit/' . $warehouse_id );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $warehouse_id
	 * @param $slot_id
	 * @return Response
	 * @internal param int $id
	 */
	public function destroy($warehouse_id, $slot_id)
	{
		//

		$slot = Slot::findOrFail($slot_id);

		$slot->delete();

		return redirect('warehouses/edit/' . $warehouse_id );
	}

	/**
	 * Destroy all the slots
	 * @param $id
     */
	public function destroyAll($id)
	{
		//
	}

}
