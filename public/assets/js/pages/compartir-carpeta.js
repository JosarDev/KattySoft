let tblUsuarios;
const btnGuardar = document.querySelector("#btnGuardar");
const carpeta_id = document.querySelector("#carpeta_id");

document.addEventListener("DOMContentLoaded", function () {
  tblUsuarios = $("#tblUsuarios").DataTable({
    responsive: true,
    ajax: {
      url: base_url + "folder/usuarios/" + carpeta_id.value,
      dataSrc: "",
    },
    columns: [
      {
        data: null,
        render: function (data, type) {
            let existe = data.existe ? 'checked' : '';
          return `<input class="form-check" type="checkbox" name="usuarios[]" value="${data.user_id}" ${existe}/>`;
        },
      },
      { data: "item" },
      { data: "correo" },
      {
        data: null,
        render: function (data, type) {
          return data.nombre + " " + data.apellido;
        },
      },
      { data: "created_at" },
      {
        data: null,
        render: function (data, type) {
          let url;
          url = base_url + "assets/images/avatars/default.png";
          if (data.avatar != null) {
            url = base_url + "assets/images/avatars/" + data.avatar;
          }
          return `<img src="${url}" class="img-fluid rounded-top" alt="Avatar" width="50" />`;
        },
      },
    ],
    language: {
      url: base_url + "assets/js/es-ES.json",
    },
    dom,
    buttons,
    order: [[4, "desc"]],
  });

  btnGuardar.addEventListener("click", function () {
    let seleccionados = [];
    document
      .querySelectorAll('input[name="usuarios[]"]:checked')
      .forEach(function (checkbox) {
        seleccionados.push(checkbox.value);
      });
    const url = base_url + "folder/compartir";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(
      JSON.stringify({
        usuarios: seleccionados,
        carpeta_id: carpeta_id.value,
      })
    );
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        alertaPesonalizada(res.type, res.msg);
      }
    };
  });
});
