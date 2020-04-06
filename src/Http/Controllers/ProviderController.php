<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\IOController;
use Illuminate\Http\Response;

use Dataview\IntranetOne\Provider;
use Dataview\IntranetOne\Category;
use Dataview\IntranetOne\Service;
use App\Http\Requests;
use Dataview\IOProvider\ProviderRequest;
use Sentinel;
use Activation;
use DataTables;
use Mail;

class ProviderController extends IOController{

	public function __construct(){
    	$this->service = 'provider';
	}

  	public function index(){
		return view('Provider::index');
	}
	
	public function list(){
		$query = Provider::select()
		->get();
		return Datatables::of($query)->make(true);
	}

  function categories($id=null) {
    if(blank($id)){
      $servId = Service::where('service','Provider')->value('id');
      $query = Category::whereNull('category_id')->where('service_id',$servId)->get(); 
    }
    else
      $query = Category::where('category_id',$id)->get(); 

    return response()->json(['success' => true, "data" => $query]);
  }


	public function view($id){
    $check = $this->__view();
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $query = Provider::select('providers.*', 'cities.city', 'cities.region')
      ->join('cities', 'providers.city_id', '=', 'cities.id')
      ->where('providers.id', $id)->get();

    return response()->json(['success' => true, 'data' => $query]);
	}

	public function create(ProviderRequest $request){
    $check = $this->__create($request);
    
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }
    
    $obj = new Provider($request->all());

    $obj->save();

    return response()->json(['success' => true, 'data' => ["id"=>$obj->id]]);
	}
	
	public function update($id, ProviderRequest $request){
    $check = $this->__update($request);
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $_new = (object) $request->all();

    $_old = Provider::find($id);

    $upd = ['name','phone'];  

    $_old->save();
    return response()->json(['success' => $_old->save()]);    
	}

	public function delete($id){
		$check = $this->__delete();
		if(!$check['status'])
			return response()->json(['errors' => $check['errors'] ], $check['code']);	

		$el = Provider::find($id);
		$el = $el->delete();
		return  json_encode(['sts'=>$el]);
	}
}
