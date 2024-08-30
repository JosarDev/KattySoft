let tblArchivos;
document.addEventListener('DOMContentLoaded', function(){
    tblArchivos = $('#tblArchivos').DataTable( {
        responsive: true,
        ajax: {
            url: base_url + 'archcompartidas/detarchivo',
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
                        <a href="${base_url + 'assets/uploads/' + data.nombre}"  download="${data.nombre}" class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
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