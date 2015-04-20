<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movingwine\Warehouse;
use GuzzleHttp\Subscriber\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WarehouseController
 * @package App\Http\Controllers
 */
class WarehouseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$warehouses = Warehouse::all();

		return view('warehouse.index', compact('warehouses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('warehouse.create', compact('warehouse'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Requests\WarehouseRequest $request
	 * @return Response
	 */
	public function store(Requests\WarehouseRequest $request)
	{

		Warehouse::create($request->all());
		return redirect('warehouses');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$warehouse = Warehouse::findOrFail($id);

		return view('warehouse.edit', compact('warehouse', 'id'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param Requests\WarehouseRequest $request
	 * @return Response
	 */
	public function update($id, Requests\WarehouseRequest $request)
	{
		//
		$warehouse = Warehouse::findOrFail($id);

		$warehouse->update($request->except(['_token']));

		return redirect('warehouses');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$warehouse = Warehouse::findOrFail($id);

		$warehouse->delete();

		return redirect('warehouses');
	}

}
