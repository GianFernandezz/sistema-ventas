// REPORTE EN PDF
document.addEventListener("DOMContentLoaded", () => {
    // Escuchamos el click del botón
    const $boton = document.querySelector("#btnCrearPdf");
    $boton.addEventListener("click", () => {
        // const $elementoParaConvertir = document.body; // <-- Aquí puedes elegir cualquier elemento del DOM
        const $elementoParaConvertir = document.querySelector("#convertirPdf"); // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: [0.2, 0.3, 0.5, 0.2],
                filename: 'Categorias.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "A4",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
});