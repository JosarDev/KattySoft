let tblUsuarios;
document.addEventListener('DOMContentLoaded', function(){
    tblUsuarios = $('#tblUsuarios').DataTable( {
        responsive: true,
        ajax: {
            url: base_url + 'usuarios/show',
            dataSrc: ''
        },
        columns: [
            { data: 'item' },
            { data: 'correo' },
            {
                data: null,
                render: function (data, type) { 
                    return data.nombre + ' ' + data.apellido;
                }
            },
            { data: 'created_at' },
            {
                data: null,
                render: function (data, type) { 
                    let rol = '';
                    if (data.rol == 1) {
                        rol = '<span class="badge bg-success">Admin</span>';
                    } else if (data.rol == 2) {
                        rol = '<span class="badge bg-primary">Invitado</span>';
                    } else if (data.rol == 3) {
                        rol = '<span class="badge bg-warning">Servicios</span>';
                    }
                    return rol;
                }
            },
            {
                data: null,
                render: function (data, type) {
                    let url;
                    url = base_url + 'assets/images/avatars/default.png';
                    if (data.avatar != null) {
                        url = base_url + 'assets/images/avatars/' + data.avatar;
                    }
                    return `<img src="${url}" class="img-fluid rounded-top" alt="Avatar" width="50" />`;
                }
            },
            {
                data: null,
                render: function (data, type) { 
                    return `<div class="btn-group ms-3" role="group" aria-label="">
                        <a href="${base_url + 'usuarios/' + data.user_id + '/edit'}" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(${data.user_id})">
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



function eliminar(user_id) {
    const url = base_url + 'usuarios/' + user_id;
    eliminarRegistro(url, tblUsuarios);
}