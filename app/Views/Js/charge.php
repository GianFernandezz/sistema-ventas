<script>
    $(document).ready(function() {
        /*===================================================================*/
        //CARGA MASIVA PARA CATEGORIA
        /*===================================================================*/
        $("#form_carga_categorias").on('submit', function(e) {

            e.preventDefault();

            /*===================================================================*/
            //VALIDAR QUE SE SELECCIONE UN ARCHIVO
            /*===================================================================*/
            if ($("#fileCategorias").get(0).files.length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Debe seleccionar un archivo (Excel).',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {

                /*===================================================================*/
                //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
                /*===================================================================*/
                let extensiones_permitidas = [".xls", ".xlsx"];
                let input_file_productos = $("#fileCategorias");
                let exp_reg = new RegExp("([a-zA-Z0-9\s_\\-.\:])+(" + extensiones_permitidas.join('|') + ")$");

                if (!exp_reg.test(input_file_productos.val().toLowerCase())) {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Debe seleccionar un archivo con extensión .xls o .xlsx.',
                        showConfirmButton: false,
                        timer: 2500
                    })

                    return false;
                }

                let datos = new FormData($(form_carga_categorias)[0]);

                $("#btnCargar").prop("disabled", true);
                $("#img_carga").attr("style", "display:block");
                // $("#img_carga").attr("style","height:200px");
                // $("#img_carga").attr("style","width:200px");

                fetch("<?= base_url('charge_excel/categoriaImport'); ?>", {
                    method: 'POST',
                    body: datos
                })
                .catch(error => console.error('Error:', error))
                .then(response => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Los datos se guardaron correctamente!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $("#btnCargar").prop("disabled", false);
                    $("#img_carga").attr("style", "display:none");

                    // LIMPIAR CAMPO FILE
                    $("#fileCategorias").val("");
                });
            }
        })

        $("#form_carga_productos").on('submit', function(e) {

            e.preventDefault();

            /*===================================================================*/
            //VALIDAR QUE SE SELECCIONE UN ARCHIVO
            /*===================================================================*/
            if ($("#fileProductos").get(0).files.length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Debe seleccionar un archivo (Excel).',
                    showConfirmButton: false,
                    timer: 2500
                })
            } else {

                /*===================================================================*/
                //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
                /*===================================================================*/
                let extensiones_permitidas = [".xls", ".xlsx"];
                let input_file_productos = $("#fileProductos");
                let exp_reg = new RegExp("([a-zA-Z0-9\s_\\-.\:])+(" + extensiones_permitidas.join('|') + ")$");

                if (!exp_reg.test(input_file_productos.val().toLowerCase())) {
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Debe seleccionar un archivo con extensión .xls o .xlsx.',
                        showConfirmButton: false,
                        timer: 2500
                    })

                    return false;
                }

                let dataProduct = new FormData($(form_carga_productos)[0]);

                $("#btnCargar2").prop("disabled", true);
                $("#img_carga2").attr("style", "display:block");
                // $("#img_carga").attr("style","height:200px");
                // $("#img_carga").attr("style","width:200px");

                fetch("<?= base_url('charge_excel/productoImport'); ?>", {
                    method: 'POST',
                    body: dataProduct
                })
                .catch(error => console.error('Error:', error))
                .then(response => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Los datos se guardaron correctamente!',
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $("#btnCargar2").prop("disabled", false);
                        $("#img_carga2").attr("style", "display:none");

                        // LIMPIAR CAMPO FILE
                        $("#fileProductos").val("");
                });
            }
        })

    })
</script>
</body>

</html>