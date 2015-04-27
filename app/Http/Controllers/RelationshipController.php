<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movingwine\Address;
use App\Movingwine\Datatable;
use App\Movingwine\Relationship;
use App\Movingwine\TmpAddress;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RelationshipController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$relationships = Relationship::all();

		return view('relationships.index', compact('relationships'));
	}

	/**
	 * Return a json array with the relationships
	 * @return array
     */
	public function indexajax()
	{
		//
		$relationships = Datatable::output(Relationship::all(), ['key'=> 'id', 'newkey' => 'Dt_Rowid', 'transform' => 'row_']);
		return ['draw' => '1', 'RecordCount' => $relationships->count(), 'data' => $relationships];
	}

	public function relationshipAddressesAjax()
	{
		$addresses = Datatable::output(Address::all(), ['key'=> 'id', 'newkey' => 'Dt_Rowid', 'transform' => 'row_']);
		return ['draw' => '1', 'RecordCount' => $addresses->count(), 'data' => $addresses];

	}

	public function relationshipTmpAddressesAjax()
	{
		$addresses = Datatable::output(TmpAddress::all(), ['key'=> 'id', 'newkey' => 'Dt_Rowid', 'transform' => 'row_']);
		return ['draw' => '1', 'RecordCount' => $addresses->count(), 'data' => $addresses];

	}
	public function relationshipTmpAddressesStore(Requests\AddressRequest $request)
	{
		$tmpAddress = new TmpAddress;
		$tmpAddress->address = $request->get('address');
		$tmpAddress->zip = $request->get('zip');
		$tmpAddress->save();
		return '{"success": true}';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('relationships.create', compact('warehouse'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\RelationshipRequest $request)
	{
		//
		Relationship::create($request->all());
		return redirect('relationships');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
