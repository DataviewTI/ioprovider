new IOService(
  {
    name: "Provider",
  },
  function(self) {
    $(this).attr("aria-pressed", true);
    self.fields = {
      category,
      ft_category,
      subcategories,
      ft_subcategories,
    };

    self.fields.subcategories = new SlimSelect({
      select: "#subcategories",
      searchText: "Nenhuma subcategoria encontrada!",
      placeholder: " ",
      limit: 3,
      searchPlaceholder: "Procurar",
      allowDeselectOption: true,
      closeOnSelect: false,
      onChange: (info) => {
        document.getElementById("__subcategories").value = info.map((el) => {
          return el.value;
        });
      },
    });

    self.fields.ft_subcategories = new SlimSelect({
      select: "#ft_subcategories",
      searchText: "Nenhuma subcategoria encontrada!",
      placeholder: "Qualquer uma",
      searchPlaceholder: "Procurar",
      allowDeselectOption: true,
      allowDeselect: true,
      deselectLabel:
        '<span class="ico ico-close" style="font-size:10px; color:red"></span>',
      closeOnSelect: false,
    });

    self.fields.category = new SlimSelect({
      select: "#category",
      searchText: "Nenhuma categoria encontrada!",
      placeholder: " ",
      searchPlaceholder: "Procurar",
      onChange: function(info) {
        if (info.value !== undefined)
          getCategories(self, info.value)
            .then((arr) => {
              const cats = arr.map(({ id, category }) => {
                return {
                  text: category,
                  value: `${id}`,
                };
              });
              self.fields.subcategories.setData(cats);

              if (this.subcats !== undefined) {
                self.fields.subcategories.set(this.subcats);
              }
              //zera o campo
              else self.fields.subcategories.set(""); //zera o campo
              this.subcats = undefined;
            })
            .catch((err) => {
              self.fields.subcategories.setData([]);
            });
        else self.fields.subcategories.setData([]);
      },
    });

    self.fields.ft_category = new SlimSelect({
      select: "#ft_category",
      searchText: "Nenhuma categoria encontrada!",
      placeholder: "Qualquer uma",
      allowDeselect: true,
      deselectLabel:
        '<span class="ico ico-close" style="font-size:10px; color:red"></span>',
      searchPlaceholder: "Procurar",
      onChange: function(info) {
        if (info.value !== undefined)
          getCategories(self, info.value)
            .then((arr) => {
              const cats = arr.map(({ id, category }) => {
                return {
                  text: category,
                  value: `${id}`,
                };
              });
              self.fields.ft_subcategories.setData(cats);
              self.fields.ft_subcategories.set(""); //zera o campo
            })
            .catch((err) => {
              self.fields.ft_subcategories.setData([]);
            });
        else self.fields.ft_subcategories.setData([]);
      },
    });

    getCategories(self)
      .then((arr) => {
        const cats = arr.map(({ id, category }) => {
          return {
            text: category,
            value: `${id}`,
            selected: false,
          };
        });
        self.fields.category.setData(cats);
        self.fields.category.set(""); //zera o campo
        self.fields.ft_category.setData(cats);
        self.fields.ft_category.set(""); //zera o campo
      })
      .catch((err) => {
        self.fields.category.setData([]);
        self.fields.ft_category.setData([]);
      });

    $("#isWhatsapp").attrchange(function(attrName) {
      if (attrName == "aria-pressed") {
        $("#__isWhatsapp").val($(this).attr("aria-pressed"));

        if ($(this).attr("aria-pressed") == "true") {
          this.nextElementSibling.style.opacity = "1";
          this.previousElementSibling.style.opacity = ".3";
        } else {
          this.nextElementSibling.style.opacity = ".3";
          this.previousElementSibling.style.opacity = "1";
        }
      }
    });

    $("#delivery").attrchange(function(attrName) {
      if (attrName == "aria-pressed") {
        $("#__delivery").val($(this).attr("aria-pressed"));

        if ($(this).attr("aria-pressed") == "true") {
          this.nextElementSibling.style.opacity = "1";
          this.previousElementSibling.style.opacity = ".3";
        } else {
          this.nextElementSibling.style.opacity = ".3";
          this.previousElementSibling.style.opacity = "1";
        }
      }
    });

    $("#phone").mask($.jMaskGlobals.SPMaskBehavior, {
      onKeyPress: function(val, e, field, options) {
        self.fv[0].revalidateField($(field).attr("id"));
        field.mask($.jMaskGlobals.SPMaskBehavior.apply({}, arguments), options);
      },
      onComplete: function(val, e, field) {
        // $(field)
        //   .parent()
        //   .parent()
        //   .next()
        //   .find("input")
        //   .first()
        //   .focus();
      },
    });

    $("#isWhatsapp").aaDefaultState();
    $("#delivery").aaDefaultState();

    let form = document.getElementById(self.dfId);
    let fv1 = FormValidation.formValidation(form, {
      fields: {
        name: {
          validators: {
            notEmpty: {
              enabled: true,
              message: "Seu nome / Nome da sua empresa ou negócio",
            },
          },
        },
        description: {
          validators: {
            notEmpty: {
              enabled: true,
              message: "A descrição é obrigatória!",
            },
            // callback: {
            //   message: "A descrição pode ter no máximo 400 caracteres!",
            //   callback: function(el) {
            //     return el.value.length <= 10;
            //   },
            // },
          },
        },
        category: {
          validators: {
            callback: {
              message: "Selecione uma categoria!",
              callback: function() {
                return self.fields.category.selected() !== undefined;
              },
            },
          },
        },
        phone: {
          validators: {
            phone: {
              country: "BR",
              message: "Telefone inválido",
            },
            notEmpty: {
              message: "O telefone é obrigatório",
            },
          },
        },
        email: {
          validators: {
            emailAddress: {
              message: "Email inválido",
            },
          },
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        submitButton: new FormValidation.plugins.SubmitButton(),
        bootstrap: new FormValidation.plugins.Bootstrap(),
        icon: new FormValidation.plugins.Icon({
          valid: "fv-ico ico-check",
          invalid: "fv-ico ico-close",
          validating: "fv-ico ico-gear ico-spin",
        }),
      },
    }).setLocale("pt_BR", FormValidation.locales.pt_BR);
    self.fv = [fv1];

    self.wizardActions(function() {
      //asasas
    });

    self.dt = $("#default-table")
      .DataTable({
        aaSorting: [[0, "desc"]],
        ajax: self.path + "/list",
        initComplete: function() {
          //parent call
          let api = this.api();
          $.fn.dataTable.defaults.initComplete(this);

          api.addDTSelectFilter([
            { el: $("#ft_whatsapp"), column: "isWhatsapp" },
            { el: $("#ft_delivery"), column: "delivery" },
            { el: $("#ft_status"), column: "status" },
            {
              el: $("#ft_category"),
              column: "categoria-principal-filter",
            },
          ]);

          api.addDTCustomFilter({
            el: $("#ft_subcategories"),
            column: "subcategories",
            callback: (data, vl) => {
              return vl.every((el) => data.includes(el));
            },
          });
        },
        footerCallback: function(row, data, start, end, display) {},
        columns: [
          // {data: "nome da coluna", name: "nome da col no datatable" }
          { data: "id", name: "id" },
          { data: "name", name: "name" },
          { data: "main_category", name: "categoria-principal" },
          { data: "main_category", name: "categoria-principal-filter" },
          { data: "subcategories", name: "subcategories" },
          { data: "phone", name: "telefone" },
          { data: "isWhatsapp", name: "isWhatsapp" },
          { data: "email", name: "email" },
          { data: "delivery", name: "delivery" },
          { data: "status", name: "status" },
          { data: "actions", name: "actions" },
        ],
        columnDefs: [
          {
            targets: "__dt_",
            width: "3%",
            class: "text-center",
            searchable: true,
            orderable: true,
          },
          {
            targets: "__dt_name",
            searchable: true,
            orderable: true,
          },
          {
            targets: "__dt_categoria-principal",
            searchable: true,
            orderable: true,
            width: "15%",

            render: function(data, type, row) {
              return data.length ? data[0].category : "";
            },
          },
          {
            targets: "__dt_categoria-principal-filter",
            visible: false,
            render: function(data, type, row) {
              return data.length ? data[0].category : "";
            },
          },
          {
            targets: "__dt_subcategories",
            visible: false,
            render: function(data, type, row) {
              return JSON.stringify(data.map((el) => el.id));
            },
          },
          {
            targets: "__dt_telefone",
            searchable: false,
            orderable: false,
            width: "10%",
          },
          {
            targets: "__dt_w",
            width: "2%",
            orderable: true,
            className: "text-center",
            render: function(data, type, row) {
              if (data == 1)
                return self.dt.addDTIcon({
                  ico: "ico-whatsapp",
                  title: "tem whatsapp",
                  value: 1,
                  pos: "left",
                  _class: "text-success",
                });
              else return self.dt.addDTIcon({ value: 0, _class: "invisible" });
            },
          },
          {
            targets: "__dt_email",
            searchable: true,
            orderable: true,
            width: "10%",
          },
          {
            targets: "__dt_d",
            width: "2%",
            orderable: true,
            className: "text-center",
            render: function(data, type, row) {
              if (data == 1)
                return self.dt.addDTIcon({
                  ico: "ico-delivery",
                  title: "Fornece Delivery",
                  value: 1,
                  pos: "left",
                  _class: "text-primary",
                });
              else return self.dt.addDTIcon({ value: 0, _class: "invisible" });
            },
          },
          {
            targets: "__dt_s",
            width: "2%",
            orderable: true,
            className: "text-center",
            render: function(data, type, row) {
              let d = {};
              switch (data) {
                case "A":
                  d = { color: "sts-ativo", v: "Ativo" };
                  break;
                case "I":
                  d = { color: "sts-inativo", v: "Inativo" };
                  break;
                case "B":
                  d = { color: "sts-bloqueado", v: "Bloqueado" };
                  break;
              }

              return self.dt.addDTButtons({
                buttons: [
                  {
                    ico: "ico-dot",
                    title: d.v,
                    value: data,
                    pos: "left",
                    _class: d.color,
                  },
                ],
              });
            },
          },
          {
            targets: "__dt_acoes",
            width: "7%",
            className: "text-center",
            searchable: false,
            orderable: false,
            render: function(data, type, row, y) {
              return self.dt.addDTButtons({
                buttons: [
                  // {
                  //   ico: 'ico-eye',
                  //   _class: 'text-primary',
                  //   title: 'Pré-visualização'
                  // },
                  { ico: "ico-edit", _class: "text-info", title: "Editar" },
                  { ico: "ico-trash", _class: "text-danger", title: "Excluir" },
                ],
              });
            },
          },
          // {
          //   targets: "__dt_ativado",
          //   width: "7%",
          //   className: "text-center",
          //   searchable: false,
          //   orderable: false,
          //   render: function(data, type, row, y) {
          //     if (data)
          //       return self.dt.addDTIcon({
          //         ico: "ico-check",
          //         value: 1,
          //         title: "usuario ativado",
          //         pos: "left",
          //         _class: "text-success",
          //       });
          //     else return self.dt.addDTIcon({ value: 0, _class: "invisible" });
          //   },
          // },
        ],
      })
      .on("click", ".btn-dt-button[data-original-title=Editar]", function() {
        var data = self.dt.row($(this).parents("tr")).data();
        self.view(data.id);
      })
      .on("click", ".ico-trash", function() {
        var data = self.dt.row($(this).parents("tr")).data();
        self.delete(data.id);
      })
      .on("click", ".ico-dot", function() {
        var data = self.dt.row($(this).parents("tr")).data();
        console.log(data.status, data);
        if (data.status !== "B") {
          toggleStatus(self, data.id)
            .then((ret) => {
              $('[data-toggle="tooltip"]').tooltip("hide");
              self.dt.ajax.reload();
              // self.dt.draw(true);
            })
            .catch((err) => {
              swal({
                title: "Ocorreu um erro, não foi possível alterar o status!",
                confirmButtonText: "ERRO",
                type: "error",
              });
            });
        } else {
          swal({
            title:
              "Não é possivel alterar um usuário bloqueado, entre em contato com os administradores",
            confirmButtonText: "ERRO",
            type: "error",
          });
        }
      })
      .on("draw.dt", function() {
        $('[data-toggle="tooltip"]').tooltip();
      });

    self.callbacks.view = view(self);

    self.callbacks.update.onSuccess = function(data) {
      self.tabs["listar"].tab.tab("show");
    };

    self.callbacks.create.onSuccess = function(data) {
      self.dt.ajax.reload();
      self.dt.draw(true);
      self.tabs["listar"].tab.tab("show");
    };

    self.callbacks.unload = function(self) {
      $("#isWhatsapp").aaDefaultState();
      $("#delivery").aaDefaultState();
      self.fields.category.set("");
      self.fields.subcategories.set("");
    };
  }
);

function getCategories(self) {
  return new Promise(function(resolve, reject) {
    try {
      $.ajax({
        headers: {
          "Content-Type": "application/json",
        },
        complete: (jqXHR) => {
          $.ajaxSettings.headers["X-CSRF-Token"] = laravel_token;
        },
        url: `${self.path}/categories`,
        success: (data) => {
          if (data.success === true) resolve(data.data);
          else reject([]);
        },
      });
    } catch (err) {
      reject([]);
    }
  });
}

function toggleStatus(self, id) {
  return new Promise(function(resolve, reject) {
    try {
      $.ajax({
        headers: {
          "Content-Type": "application/json",
        },
        complete: (jqXHR) => {
          $.ajaxSettings.headers["X-CSRF-Token"] = laravel_token;
        },
        url: `${self.path}/toggle-state/${id}`,
        success: (data) => {
          if (data.success === true) resolve();
          else reject();
        },
      });
    } catch (err) {
      reject();
    }
  });
}

function getCategories(self, id) {
  return new Promise(function(resolve, reject) {
    try {
      $.ajax({
        headers: {
          "Content-Type": "application/json",
        },
        complete: (jqXHR) => {
          $.ajaxSettings.headers["X-CSRF-Token"] = laravel_token;
        },
        url:
          id === undefined
            ? `${self.path}/categories`
            : `${self.path}/categories/${id}`,
        success: (data) => {
          if (data.success === true) resolve(data.data);
          else reject([]);
        },
      });
    } catch (err) {
      reject([]);
    }
  });
}

//CRUD CallBacks
function view(self) {
  return {
    onSuccess: function(data) {
      $("[name='name']").val(data.name);
      $("[name='description']").val(data.name);
      $("#phone")
        .val(data.phone)
        .trigger("input");
      console.log("AA", data.isWhatsapp === 1);
      $("#isWhatsapp").aaToggle(data.isWhatsapp === 1);
      $("#delivery").aaToggle(data.delivery === 1);

      $("[name='email']").val(data.email);
      $("[name='instagram']").val(data.instagram);

      // console.log();
      self.fields.category.subcats = data.subcategories.map((el) => {
        return el.id;
      });

      self.fields.category.set(
        data.main_category.map((el) => {
          return el.id;
        })
      );
      // .then((xx) => {})
      // .catch((err) => {
      //   console.log("asas");
      // });
    },
    onError: function(self) {
      console.log("executa algo no erro do callback");
    },
  };
}
