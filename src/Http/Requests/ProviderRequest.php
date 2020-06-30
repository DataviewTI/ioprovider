<?php

namespace Dataview\IOProvider;
use Dataview\IntranetOne\IORequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends IORequest
{
  public function sanitize(){
    $input = parent::sanitize();
    

    if (isset($input['cpf_cnpj']))
      $input['cpf_cnpj'] = preg_replace('/\D/', '', $input['cpf_cnpj']);

    $input['isWhatsapp'] = $input['__isWhatsapp'] == "false" ? false : true;
    $input['delivery'] = $input['__delivery'] == "false" ? false : true;

    $input['featured'] = $this->has('__featured') ? $input['__delivery']  : false;

    $input['sizes'] = $input['__dz_copy_params'];


    $input['subcategories'] = blank($input['__subcategories']) ? [] : explode(",",$input['__subcategories']);

    $this->replace($input);
    return $input;
	}

  

  protected function prepareForValidation()
  {
    $this->merge([
        'cpf_cnpj' => preg_replace('/\D/', '', $this->cpf_cnpj)
    ]);
  }

  public function rules(){
    $san = (object) $this->sanitize();


    $isUpdate = optional($san)->isUpdate ? $san->isUpdate : null;

    return [
      'cpf_cnpj' => "required|unique:providers,cpf_cnpj,{$isUpdate},id",
      'email' => "bail|nullable|email|unique:providers,email,{$isUpdate},id",
      'description'=>"bail|max:200"
    ]; 
  }

  public function messages(){
    return [
      'cpf_cnpj.unique' => 'Este CPF/CNPJ já foi informado anteriormente!',
      'instagram.unique' => 'Este instagram já foi informado anteriormente!',
      'email.unique' => 'Este email já foi informado anteriormente!',
    ];
  }
}
