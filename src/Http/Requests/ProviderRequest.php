<?php

namespace Dataview\IOProvider;
use Dataview\IntranetOne\IORequest;

class ProviderRequest extends IORequest
{
  public function sanitize(){
    $input = parent::sanitize();

    //
    // if(isset())
    //   $input['start_at'] = str_replace(' ','',date($input['video_start_at']));
    // else

    $input['isWhatsapp'] = $input['__isWhatsapp'] == "false" ? false : true;
    $input['delivery'] = $input['__delivery'] == "false" ? false : true;
    // $input['isUpdate'] = $input['__delivery'] == "false" ? false : true;

    $input['subcategories'] = blank($input['__subcategories']) ? [] : explode(",",$input['__subcategories']);

    $this->replace($input);
    return $input;
	}

  public function rules(){
    $san = $this->sanitize();
    $isUpdate = $san['isUpdate'] ? $san['isUpdate'] : null;
    return [
      'instagram' => "bail|nullable|unique:providers,instagram,{$isUpdate},id",
      'email' => "bail|nullable|email|unique:providers,email,{$isUpdate},id",
      'description'=>"bail|max:400"
    ]; 
  }

  public function messages(){
    return [
      'instagram.unique' => 'Este instagram já foi informado para outro usuário',
      'email.unique' => 'Este email já foi informado por outro usuário',
    ];
  }
}
