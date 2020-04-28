<div class = 'row pt-2'>
  <div class="col-sm-6 col-xs-12" style = 'border-right:1px #e1f0ee solid'>
    <div class = 'row'>
      <div class="col-sm-3 col-xs-12 pl-0">
        <div class="form-group">
          <label for='cpf_cnpj'>CPF / CNPJ</label>
          <input type="text" id='cpf_cnpj' name='cpf_cnpj' class = 'form-control input-lg' />
        </div>
      </div>
      <div class="col-sm-9 col-xs-12">
        <div class="form-group">
          <label for = 'name' class="bmd-label-floating __required"><span class="ico ico-business-card"></span> Seu nome / Nome da sua empresa ou negócio</label>
          <input name = 'name' type = 'text' class = 'form-control form-control-lg' />
        </div>
      </div>
    </div>
    <div class = 'row'>
      <div class="col-12 pl-0">
        <div class="form-group">
          <label for='description'><span class="ico ico-list"></span> Descreva da melhor os produtos/serviços que oferece</label>
          <textarea id='description' maxlength="400" name='description' class='form-control input-lg' style="height:80px" placeholder="Por exemplo: Vendo espetinhos de carne,frango, linguiça, simples e completo, jantinha com feijão tropeiro, torresmo etc..."></textarea>
        </div>
      </div>
    </div>

    <div class = 'row'>
      <div class="col-sm-3 col-xs-12 pl-0">
        <div class="form-group">
          <label for='phone'><span class="ico ico-phone"></span> Telefone de contato</label>
          <input type="text" id='phone' name='phone' class = 'form-control input-lg' />
        </div>
      </div>

      <div class="col-sm-4 col-xs-12">
        <div class="form-group">
          <label for = 'isWhatsapp' class="bmd-label-floating __required"><span class="ico ico-whatsapp"></span> esse telefone é whatsapp?</label>
          <br>
          <div class="text-center mt-3 aanjulena-container">
            <span class="my-auto mt-2 aanjulena-no">Não</span>
            <button type="button" class="btn btn-sm aanjulena-btn-toggle active"
                data-toggle="button" aria-pressed="true" 
                data-default-state='false' autocomplete="off" name = 'isWhatsapp' id = 'isWhatsapp'
                >
              <div class="handle"></div>
            </button>
            <span class="my-auto mt-2 aanjulena-yes">Sim</span>
            <input type = 'hidden' name = '__isWhatsapp' id = '__isWhatsapp' />
          </div>
        </div>
      </div>

      <div class="col-sm-5 col-xs-12">
        <div class="form-group">
          <label for = 'delivery' class="bmd-label-floating __required"><span class="ico ico-delivery"></span> Faz entrega em domicílio (delivery)</label>
          <br>
          <div class="text-center mt-3 aanjulena-container">
            <span class="my-auto mt-2 aanjulena-no">Não</span>
            <button type="button" class="btn btn-sm aanjulena-btn-toggle active"
                data-toggle="button" aria-pressed="true" 
                data-default-state='false' autocomplete="off" name = 'delivery' id = 'delivery'
                >
              <div class="handle"></div>
            </button>
            <span class="my-auto mt-2 aanjulena-yes">Sim</span>
            <input type = 'hidden' name = '__delivery' id = '__delivery' />
          </div>
        </div>
      </div>
    </div>

    <div class = 'row'>
      <div class="col-sm-7 col-xs-12 pl-0">
        <div class="form-group">
          <label for='email'><span class="ico ico-email"></span> email</label>
          <input type="email" id='email' name='email' class = 'form-control input-lg'/>
        </div>
      </div>
      <div class="col-sm-5 col-xs-12 pl-0">
        <div class="form-group">
          <label for='instagram'><span class="ico ico-instagram"></span> Qual é seu Instagram?</label>
          <input type="text" id='instagram' name='instagram' placeholder="Ex: @meuinstagram" class = 'form-control input-lg' />
        </div>
      </div>
    </div>    
  </div>
  
  <div class="col-sm-6 col-xs-5">
    <div class = 'row'>
      <div class="col-sm-12 col-xs-12 slim-select-container">
        <div class="form-group">
          <label for = 'name' class="bmd-label-floating __required mb-3">
            Escolha a categoria principal que mais se adequa ao seu negócio
          </label>
          <select id="category" name = "category">
          </select>          
        </div>
      </div>
    </div>

    <div class = 'row'>
      <div class="col-sm-12 col-xs-12">
        <div class="form-group">
          <label for = 'name' class="bmd-label-floating __required mb-3">
            Selecione até 3 subcategorias que melhor definem seu produto ou serviço
          </label>
          <select id="subcategories" name = "subcategories" multiple>
            <option data-placeholder="true"></option>
          </select>          
          <input type = "hidden" name = "__subcategories" id="__subcategories" />
        </div>
      </div>
    </div>

  </div>  
    
</div>

      {{-- <div class = 'row'>
        <div class="col-8">
          <div class="form-group">
            <label for = 'email' class="bmd-label-floating __required">Email</label>
            <input name = 'email' type = 'text' class = 'form-control form-control-lg' />
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label for = 'admin' class="bmd-label-floating __required">Administrador?</label>
            <br>
            <button type="button" class="btn btn-lg aanjulena-btn-toggle btn-lg active"
                    data-toggle="button" aria-pressed="true" 
                    data-default-state='true' autocomplete="off" name = 'admin' id = 'admin'
                    style="margin: 0; margin-left: 40px; margin-top: 10px;">
                <div class="handle"></div>
            </button>
            <input type = 'hidden' name = '__admin' id = '__admin' />
          </div>
        </div>
      </div>
    </div>
  </div> --}}