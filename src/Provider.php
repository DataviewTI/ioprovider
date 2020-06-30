<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\IOModel;
use Dataview\IntranetOne\Group;
use Dataview\IntranetOne\Category;
use Dataview\IntranetOne\Service;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends IOModel
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = "providers";
    // protected $hidden = array('pivot');


    protected $fillable = [
        'name',
        'cpf_cnpj',
        'phone',
        'email',
        'description',
        'instagram',
        'isWhatsapp',
        'delivery',
        'city_id',
        'status',
        'group_id',
      ];

    protected $dates = ['deleted_at'];

    public function city(){
      return $this->belongsTo('City');
    }

    public function categories(){
      return $this->belongsToMany('Dataview\IntranetOne\Category','provider_category');
    }

    public function subcategories(){
      return $this->belongsToMany('Dataview\IntranetOne\Category','provider_category')
        ->whereNotNull('categories.category_id')
        ->orderBy('categories.updated_at');
    }

    public function group(){
      return $this->belongsTo('Dataview\IntranetOne\Group');
    }

    public function mainCategory(){
      return $this->belongsToMany('Dataview\IntranetOne\Category','provider_category')
        ->whereNull('categories.category_id')
        ->orderBy('categories.updated_at');
    }

  public static function boot(){ 
    parent::boot(); 

    static::created(function (Provider $obj) {
      if($obj->getAppend("hasImages")){
        $group = new Group([
          'group' => "Provider`s album ".$obj->id,
          'sizes' => $obj->getAppend("sizes"),
          'service_id' => Service::where('alias','provider')->value('id')
        ]);
        $group->save();
        $obj->group()->associate($group)->save();
      }
    });
  }
}
