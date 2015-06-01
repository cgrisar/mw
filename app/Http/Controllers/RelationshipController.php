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
	public function spa()
	{
		$relationships = Relationship::all();
		return view('relationships.index', compact('relationships'));
	}

	/**
	 * Return a json array with the relationships
	 * @return array
     */
	public function index()
	{
		//
		$relationships = Datatable::output(Relationship::all(), ['key'=> 'id', 'newkey' => 'Dt_Rowid', 'transform' => 'row_']);
		return ['draw' => '1', 'RecordCount' => $relationships->count(), 'data' => $relationships];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('relationships.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\RelationshipRequest $request)
	{
		// first, store the core data of the relationship
		$relationship = Relationship::create($request->all());

		// now get the data from tmpAddresses and store them in Addresses
		$tmpAddresses = TmpAddress::all();
		foreach ($tmpAddresses as $tmpAddress) {
			if (!$tmpAddress['relationship_id']) {
				$tmpAddress['relationship_id'] = $relationship->id;
			};
			$addressModel = new Address($tmpAddress->toArray());
			$relationship->addresses()->save($addressModel);
		}

		// and delete all content in the TmpAddress table
		TmpAddress::truncate();

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
		// copy the data from addresses to tmpaddresses
		$addresses = Address::where('relationship_id', '=', $id)->get();
		foreach($addresses as $address){
			$tmpAddress = TmpAddress::create($address->toArray());
		};
		// show the edit form
		return view('relationships.edit');
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
		// update the record in the relationship table
		// destroy the relationship's addresses in the addresses table
		// store the tmpaddresses into the addresses table
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
