/* const msgRespuesta = document.querySelector('#msgRespuesta');
const busqueda = document.querySelector('#busqueda');
$(function () {
  $("#busqueda").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: base_url + 'archivos/busqueda',
        dataType: "json",
        data: {
          term: request.term
        },
        success: function (data) {
          response(data);
          if (data.length > 0) {
            msgRespuesta.textContent = '';
          } else {
            msgRespuesta.textContent = 'No hay resultado';
          }
        }
      });
    },
    minLength: 2,
    select: function (event, ui) {
      let ruta;
      if (ui.item.tipo === 'archivo') {
        ruta = base_url + 'assets/uploads/' + ui.item.value;
        window.open(ruta);
      } else {
        ruta = base_url + 'carpeta/' + ui.item.id;
        window.location = ruta;
      }
      busqueda.value = '';
      return false;
    }
  });
}); */

function eliminarRegistro(url, tbl) {
  Swal.fire({
    title: "Esta seguro de eliminar?",
    text: "El registro se eliminará de forma permanente!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const data = new FormData();
      data.append("_method", "DELETE");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPesonalizada(res.type, res.msg);
          if (res.type == "success") {
            if (tbl != null) {
              tbl.ajax.reload();
            } else {
              setTimeout(() => {
                window.location.reload();
              }, 1000);
            }

          }
        }
      };
    }
  });
}

function alertaPesonalizada(tipo, mensaje) {
  Swal.fire({
    position: "top-end",
    icon: tipo,
    title: mensaje,
    showConfirmButton: false,
    timer: 1500,
    toast: true
  });
}