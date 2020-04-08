<div class = 'row dt-filters-container pt-3'>
  <div class="col-sm-2 col-xs-12">
    <div class="form-group">
      <label for = 'ft_search' class = 'bmd-label-static mb-1'><i class = 'ico ico-filter'></i> Palavra Chave</label>
      <input type = 'text' class = 'form-control form-control-lg' name ='ft_search' id = 'ft_search' />
    </div>
  </div>
  <div class="col-sm-10 col-xs-12 ">
    <div class = 'row'>
      <div class="col-sm-3 col-xs-12 slim-select-container">
        <div class="form-group">
          <label for = 'ft_categoria' class = 'bmd-label-static mb-2'><i class = 'ico ico-filter'></i> Categoria</label>
          <select id="ft_category" name = "ft_category">
          </select>          
        </div>    
      </div>
      <div class="col-sm-5 col-xs-12 slim-select-container">
        <div class="form-group">
          <label for = 'ft_subcategories' class = 'bmd-label-static mb-2'><i class = 'ico ico-filter'></i> Subcategorias</label>
          <select id="ft_subcategories" name = "ft_subcategories" multiple>
          </select>          
        </div>    
      </div>
      <div class="col-sm-4 col-xs-12">
        <div class = 'row'>
          <div class="col-sm-4 col-xs-12">
            <div class="form-group">
              <label for = 'ft_whatsapp' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Whatsapp</label>
              <select id = 'ft_whatsapp' class = 'form-control form-control-lg'>
                <option value = ''></option>
                <option value = '1'>Sim</option>
                <option value = '0'>Não</option>
              </select>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="form-group">
              <label for = 'ft_delivery' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Delivery</label>
              <select id = 'ft_delivery' class = 'form-control form-control-lg'>
                <option value = ''></option>
                <option value = '1'>Sim</option>
                <option value = '0'>Não</option>
              </select>
            </div>
          </div>
           <div class="col-sm-4 col-xs-12">
            <div class="form-group">
              <label for = 'ft_status' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Status</label>
              <select id = 'ft_status' class = 'form-control form-control-lg'>
                <option value = ''></option>
                <option value = 'A'>Ativo</option>
                <option value = 'I'>Inativo</option>
                <option value = 'B'>Bloqueado</option>
              </select>
            </div>
          </div>
        </div>
      </div>
		</div>
  </div>
    {{-- <div class="form-group">
      <label for = 'ft_category' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Categoria</label>
      <select id = 'ft_category' class = 'form-control form-control-lg'>
        @php
          $servId = Dataview\IntranetOne\Service::where('service','Provider')->value('id');
          $cats = Dataview\IntranetOne\Category::whereNull('category_id')->where('service_id',$servId)->get(); 
        @endphp
        <option value = ''></option>
        @foreach($cats as $c)
          <option value = '{{$c->id}}'>{{$c->category}}</option>
          @endforeach
      </select>
    </div> --}}
    {{-- <div class="col-md-2 col-sm-12">
      <div class="form-group">
        <label for = 'ft_subcategory' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> SubCategoria</label>
        <select id = 'ft_subcategory' disabled class = 'form-control form-control-lg'>
        </select>
      </div>
    </div>
    <div class="col-md-2 col-sm-12">
      <div class="form-group">
        <label for = 'subtitulo' class = 'bmd-label-static'><i class = 'ico ico-filter'></i> Destaque?</label>
        <select id = 'ft_featured' class = 'form-control form-control-lg'>
          <option value = ''></option>
          <option value = '1'>Sim</option>
          <option value = '0'>Não</option>
        </select>
      </div>
    </div> --}}
    
  </div>
	@component('IntranetOne::io.components.datatable',[
	"_id" => "default-table",
  "_class"=>"",
	"_columns"=> [
			["title" => "#"],
			["title" => "Nome / Negócio"],
			["title" => "Categoria Principal"],
			["title" => "Categoria Principal Filter"],
			["title" => "subcategories"],
			["title" => "Telefone"],
			["title" => "W"],
			["title" => "email"],
			["title" => "D"],
			["title" => "S"],
			["title" => "Ações"],
		]
	])
@endcomponent