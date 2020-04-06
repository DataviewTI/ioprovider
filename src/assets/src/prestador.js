new IOService(
  {
    name: "Provider",
  },
  function (self) {
    $(this).attr("aria-pressed", true);

    let __cat, __subcats;

    __subcats = new SlimSelect({
      select: "#subcategories",
      searchText: "Nenhuma subcategoria encontrada!",
      placeholder: " ",
      limit: 3,
      searchPlaceholder: "Procurar",
      allowDeselectOption: true,
      closeOnSelect: false,
      onChange: (info) => {
        console.log(info);
      },
    });

    __cat = new SlimSelect({
      select: "#categorie",
      searchText: "Nenhuma categoria encontrada!",
      placeholder: " ",
      searchPlaceholder: "Procurar",
      onChange: (info) => {
        if (info.value !== undefined)
          getCategories(self, info.value)
            .then((arr) => {
              const cats = arr.map(({ id, category }) => {
                return {
                  text: category,
                  value: `${id}`,
                };
              });
              __subcats.setData(cats);
              __subcats.set(""); //zera o campo
            })
            .catch((err) => {
              console.log("errr", err);
              __subcats.setData([]);
            });
        else __subcats.setData([]);
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
        __cat.setData(cats);
        __cat.set(""); //zera o campo
      })
      .catch((err) => {
        console.log("errr", err);
        __cat.setData([]);
      });

    $("#isWhatsapp").attrchange(function (attrName) {
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

    $("#delivery").attrchange(function (attrName) {
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
      onKeyPress: function (val, e, field, options) {
        self.fv[0].revalidateField($(field).attr("id"));
        field.mask($.jMaskGlobals.SPMaskBehavior.apply({}, arguments), options);
      },
      onComplete: function (val, e, field) {
        $(field).parent().parent().next().find("input").first().focus();
      },
    });

    $("#isWhatsapp").aaDefaultState();

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
              message: "O sobrenome é obrigatório",
            },
          },
        },
        email: {
          validators: {
            notEmpty: {
              enabled: true,
              message: "O email é obrigatória",
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

    self.wizardActions(function () {});

    self.dt = $("#default-tableX")
      .DataTable({
        aaSorting: [[0, "desc"]],
        ajax: self.path + "/list",
        initComplete: function () {
          //parent call
          let api = this.api();
          this.teste = 10;
          $.fn.dataTable.defaults.initComplete(this);
        },
        footerCallback: function (row, data, start, end, display) {},
        columns: [
          { data: "id", name: "id" },
          { data: "first_name", name: "first_name" },
          { data: "last_name", name: "last_name" },
          { data: "email", name: "email" },
          { data: "admin", name: "admin" },
          { data: "activated", name: "activated" },
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
            targets: "__dt_admin",
            width: "2%",
            orderable: true,
            className: "text-center",
            render: function (data, type, row) {
              if (data)
                return self.dt.addDTIcon({
                  ico: "ico-check",
                  value: 1,
                  title: "usuario administrador",
                  pos: "left",
                  _class: "text-success",
                });
              else return self.dt.addDTIcon({ value: 0, _class: "invisible" });
            },
          },
          {
            targets: "__dt_acoes",
            width: "7%",
            className: "text-center",
            searchable: false,
            orderable: false,
            render: function (data, type, row, y) {
              return self.dt.addDTButtons({
                buttons: [
                  // {
                  //   ico: 'ico-eye',
                  //   _class: 'text-primary',
                  //   title: 'Pré-visualização'
                  // },
                  { ico: "ico-edit", _class: "text-info", title: "Editar" },
                  { ico: "ico-trash", _class: "text-danger", title: "Excluir" },
                  {
                    ico: "ico-mail",
                    _class: row.activated
                      ? "text-success invisible"
                      : "text-success",
                    title: "Reenviar email de confirmação",
                  },
                ],
              });
            },
          },
          {
            targets: "__dt_ativado",
            width: "7%",
            className: "text-center",
            searchable: false,
            orderable: false,
            render: function (data, type, row, y) {
              if (data)
                return self.dt.addDTIcon({
                  ico: "ico-check",
                  value: 1,
                  title: "usuario ativado",
                  pos: "left",
                  _class: "text-success",
                });
              else return self.dt.addDTIcon({ value: 0, _class: "invisible" });
            },
          },
        ],
      })
      .on("click", ".btn-dt-button[data-original-title=Editar]", function () {
        var data = self.dt.row($(this).parents("tr")).data();
        self.view(data.id);
      })
      .on("click", ".ico-trash", function () {
        var data = self.dt.row($(this).parents("tr")).data();
        self.delete(data.id);
      })
      .on("click", ".ico-mail", function () {
        var data = self.dt.row($(this).parents("tr")).data();
        $.ajax({
          url: "/admin/user/createActivation/" + data.id,
          method: "GET",
          beforeSend: function () {
            HoldOn.open({
              message: "Enviando email, aguarde...",
              theme: "sk-bounce",
            });
          },
          success: function (data) {
            console.log(data);
            HoldOn.close();
            if (data.success) {
              swal({
                title:
                  "Um email de confirmação foi enviado para o email " +
                  data.message,
                confirmButtonText: "OK",
                type: "success",
              });
            } else {
              swal({
                title:
                  "Não foi possível enviar o email de confirmação. Verifique se o email cadastrado está correto",
                confirmButtonText: "OK",
                type: "error",
              });
            }
          },
          error: function (ret) {
            self.defaults.ajax.onError(ret, self.callbacks.create.onError);
          },
        }); //end ajax
      })
      .on("draw.dt", function () {
        $('[data-toggle="tooltip"]').tooltip();
      });

    self.callbacks.view = view(self);

    self.callbacks.update.onSuccess = function (data) {
      if (data.email)
        toastr.success(
          "Clique no link presente no email para ativar o cadastro",
          "Um email de confirmação foi enviado para " + data.email,
          { timeOut: 10000 }
        );
      self.tabs["listar"].tab.tab("show");
    };

    self.callbacks.create.onSuccess = function (data) {
      toastr.success(
        "Clique no link presente no email para ativar o cadastro",
        "Um email de confirmação foi enviado para " + data.data,
        { timeOut: 10000 }
      );
      self.dt.ajax.reload();
      self.dt.draw(true);
      self.tabs["listar"].tab.tab("show");
    };

    self.callbacks.unload = function (self) {
      $(".aanjulena-btn-toggle").aaDefaultState();

      $("#__sl-main-group")
        .find(".list-group-item")
        .each(function (i, obj) {
          let appended = false;
          $(".__sl-box-source").each(function (j, source) {
            if ($(source).find(".list-group-item").length < 9 && !appended) {
              $(obj).appendTo($(source));
              appended = true;
            }
          });
        });

      self.fv[0].enableValidator("password");
    };
  }
);

function getCategories(self) {
  return new Promise(function (resolve, reject) {
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

function getCategories(self, id) {
  return new Promise(function (resolve, reject) {
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
    onSuccess: function (data) {
      console.log(data);

      $("[name='first_name']").val(data.first_name);
      $("[name='last_name']").val(data.last_name);
      $("[name='email']").val(data.email);
      $("#admin").aaToggle(data.admin);
    },
    onError: function (self) {
      console.log("executa algo no erro do callback");
    },
  };
}
