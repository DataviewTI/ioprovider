<?php

namespace Dataview\IOProvider;
use Dataview\IntranetOne\IORequest;

class ProviderRequest extends IORequest
{
  public function sanitize(){
    $input = parent::sanitize();
    $this->replace($input);
	}

  public function rules(){
    $this->sanitize();
    $rules = null;

    $rules = [

    ];
    return $rules;
  }
}
