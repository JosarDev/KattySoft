const btnNuevo = document.querySelector("#btnNuevo");
const frmCarpeta = document.querySelector("#frmCarpeta");
const btnGuardar = document.querySelector("#btnGuardar");
const modalTitleId = document.querySelector("#modalTitleId");

const btnEditar = document.querySelector("#btnEditar");
const btnEliminar = document.querySelector("#btnEliminar");
const btnCompartir = document.querySelector("#btnCompartir");

const myModal = new bootstrap.Modal(document.getElementById("modalCarpeta"));
const modalAccion = new bootstrap.Modal(document.getElementById("modalAccion"));

const btnNuevaCarpeta = document.querySelector("#btnNuevaCarpeta");

const msgRespuesta = document.querySelector('#msgRespuesta');
const busqueda = document.querySelector('#busqueda');

document.addEventListener("DOMContentLoaded", function () {
  if (btnNuevo) {
    //NUEVA CARPETA
    btnNuevo.onclick = function () {
      modalTitleId.textContent = "Nueva Carpeta";
      frmCarpeta.id_carpeta.value = "";
      frmCarpeta.id_subcarpeta.value = "";
      frmCarpeta.reset();
      myModal.show();
    };
  }

  //CREAR CARPETA
  frmCarpeta.onsubmit = function (e) {
    e.preventDefault();
    if (frmCarpeta.nombre.value == "") {
      alertaPesonalizada("warning", "El nombre es requerido");
    } else {
      const url = base_url + "carpetas";
      const data = new FormData(this);
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPesonalizada(res.type, res.msg);
          if (res.type == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          }
        }
      };
    }
  };

  //MODIFICAR CARPETA
  btnEditar.onclick = function () {
    const url = base_url + "carpetas/" + frmCarpeta.id_carpeta.value + "/edit";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        modalTitleId.textContent = "Editar Carpeta";
        frmCarpeta.nombre.value = res.carpeta.nombre;
        modalAccion.hide();
        myModal.show();
      }
    };
  };

  //ELIMINAR CARPETA
  btnEliminar.onclick = function () {
    const url = base_url + "carpetas/" + frmCarpeta.id_carpeta.value;
    eliminarRegistro(url, null);
  };

  //NUEVA SUB CARPETA
  btnNuevaCarpeta.onclick = function () {
    modalTitleId.textContent = "Nueva Carpeta";
    frmCarpeta.id_subcarpeta.value = id_carpeta.value;
    frmCarpeta.id_carpeta.value = "";
    frmCarpeta.nombre.value = "";
    modalAccion.hide();
    myModal.show();
  };

  //COMPARTIR CARPETA
  btnCompartir.onclick = function(){
    window.location = base_url + 'folder/' + id_carpeta.value + '/share'
  }

  //BUSQUEDA
  $( "#busqueda" ).autocomplete({
    source: function( request, response ) {
      $.ajax( {
        url: base_url + 'archivos/busqueda',
        dataType: "json",
        data: {
          term: request.term
        },
        success: function( data ) {
          response( data );
          if (data.length > 0) {
            msgRespuesta.textContent = '';
          } else {
            msgRespuesta.textContent = 'No hay resultado';
          }
        }
      } );
    },
    minLength: 2,
    select: function( event, ui ) {
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
  } );
});

function accionCarpeta(carpeta_id) {
  frmCarpeta.id_carpeta.value = carpeta_id;
  modalAccion.show();
}
