let tblArchivos;
const carpeta_id = document.querySelector('#carpeta_id');
document.addEventListener('DOMContentLoaded', function(){
    tblArchivos = $('#tblArchivos').DataTable( {
        responsive: true,
        ajax: {
            url: base_url + 'archivos/show/' + carpeta_id.value,
            dataSrc: 'archivos'
        },
        columns: [
            { data: 'item' },
            { data: 'nombre' },
            { data: 'tipo' },
            { data: 'created_at' },
            {
                data: null,
                render: function (data, type) { 
                    return `<div class="btn-group ms-3" role="group" aria-label="">
                        <a href="${base_url + 'archivos/' + data.archivo_id + '/share'}" class="btn btn-info btn-sm">
                            <i class="fas fa-share"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(${data.archivo_id})">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>`;
                }
            },
        ],
        language: {
            url: base_url + 'assets/js/es-ES.json',
        },
        dom,
        buttons,
        order: [[3, 'desc']]
    } ); 
})

function eliminar(archivo_id) {
    const url = base_url + 'archivos/' + archivo_id;
    eliminarRegistro(url, tblArchivos);
}