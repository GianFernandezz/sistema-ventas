<script>
    // Restaurar valores al cargar la página
    window.onload = function() {
        var fecha1 = localStorage.getItem("fechaInicio");
        var fecha2 = localStorage.getItem("fechaFin");

        if (fecha1) {
            document.querySelector('[name="fechaInicio"]').value = fecha1;
        }

        if (fecha2) {
            document.querySelector('[name="fechaFin"]').value = fecha2;
        }
    };

    // Guardar valores antes de enviar el formulario
    document.getElementById("saleDateForm").addEventListener("submit", function(event) {
        var fecha1 = document.getElementsByName("fechaInicio")[0].value;
        var fecha2 = document.getElementsByName("fechaFin")[0].value;

        localStorage.setItem("fechaInicio", fecha1);
        localStorage.setItem("fechaFin", fecha2);
    });

    // ! -> METODO DEL BOTON PARA EXPORTAR DATA PDF
    $("#exportPdfSale").on("click", function(event) {
        event.preventDefault();
        let fecha1 = $('#fechaInicio').val();
        let fecha2 = $('#fechaFin').val();
        window.location.href = "/export-pdf-ventas/" + fecha1 + "/" + fecha2;
    });
    // ! -> METODO DEL BOTON PARA EXPORTAR DATA PDF | END
    
    // TODO -> METODO DEL BOTON PARA EXPORTAR DATA EXCEL
    $("#exportExcelSale").on("click", function(event) {
        event.preventDefault();
        let fecha1 = $('#fechaInicio').val();
        let fecha2 = $('#fechaFin').val();
        window.location.href = "/export-excel-ventas/" + fecha1 + "/" + fecha2;
    });
    // TODO -> METODO DEL BOTON PARA EXPORTAR DATA EXCEL | END
</script>