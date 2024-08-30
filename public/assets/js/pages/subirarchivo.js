Dropzone.options.uploadForm = {
    dictDefaultMessage: 'ARRASTAR O SALTAR ARCHIVOS',
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 100,
    // The setting up of the dropzone
    init: function() {
        var myDropzone = this;
        this.on("successmultiple", function(files, response) {
            alertaPesonalizada(response.type, response.msg);
            if (response.type == 'success') {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        });
        this.on("errormultiple", function(files, response) {
            console.log(response);
        });
    }
}
Dropzone.discover();