@php
    use Dataview\IntranetOne\IntranetOneController;
    $servicesList = IntranetOneController::getServices();

    echo "<script>"
		."var servicesList = ".json_encode($servicesList).";"
		."</script>";
@endphp
<form action = '/admin/provider/create' id='default-form' enctype="multipart/form-data" method = 'post' class = 'form-fit'>
    @component('IntranetOne::io.components.wizard',[
      "_id" => "default-wizard",
      "_min_height"=>"405px",
      "_steps"=> [
          ["name" => "Dados Gerais", "view"=> "Provider::form-general"],
          ["name" => "Imagens", "view"=> "IntranetOne::io.forms.form-images",
            "params"=>[
              "id"=>"custom-dropzone"
          ]],
        ],
    ])
    @endcomponent
  </form>