<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\IOModel;
use Dataview\IntranetOne\Group;
use Dataview\IntranetOne\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends IOModel
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = "providers";
    // protected $hidden = array('pivot');


    protected $fillable = [
        'name',
        'phone',
        'instagram',
        'isWhatsapp',
        'isWhatsapp',
        'email',
        'description',
        'city_id',
        'group_id',
      ];

    protected $dates = ['deleted_at'];

    public function city(){
      return $this->belongsTo('City');
    }

    public function categories(){
      return $this->belongsToMany('Dataview\IntranetOne\Category','provider_category');
    }


  // public static function boot(){ 
  //   parent::boot(); 
  // }
}
