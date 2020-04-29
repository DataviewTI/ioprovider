<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\IOController;
use Illuminate\Http\Response;

use Dataview\IOProvider\Provider;
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

		$query = Provider::with(['mainCategory','subcategories'])->inRandomOrder()->get();
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

    $query = Provider::with(['mainCategory','subcategories'])
      ->where('providers.id', $id)->get();

    return response()->json(['success' => true, 'data' => $query]);
	}

	public function create(ProviderRequest $request){
    $data = $request->all();
    $data_obj = (object) $data;   

    if(blank(optional($data_obj)->fromsite)){
      $check = $this->__create($request);
    
      if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
      }
    }

    $obj = new Provider($data);
    $obj->save();
    $cats = array_merge([$data["category"]],$data["subcategories"]);
    $obj->categories()->sync($cats);
    return response()->json(['success' => true, 'data' => ["id"=>$obj->id]]);
	}
	
	public function update($id, ProviderRequest $request){
    $check = $this->__update($request);
    if (!$check['status']) {
        return response()->json(['errors' => $check['errors']], $check['code']);
    }

    $_new = (object) $request->all();

    $_old = Provider::find($id);

    // dump($_new);

    $upd = ['name','phone','description','instagram','isWhatsapp','delivery','email'];  

    foreach($upd as $u)
      $_old->{$u} = optional($_new)->{$u};

    $cats = array_merge([$_new->category],$_new->subcategories);

    $_old->categories()->sync($cats);

    $_old->save();
    return response()->json(['success' => $_old->save()]);    
	}

	public function toggleState($id){
    $el = Provider::find($id);

    if(filled($el)){
      $val = $el->status;
      $el->status = $el->status == "A" ? "I" : "A"; 
      $el->save();
      return response()->json(['success' => true]);    
    }
    return response()->json(['success' => false]);
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
