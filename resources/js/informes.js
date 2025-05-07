import Chart from "chart.js/auto";

// Esperar a que el DOM esté cargado
document.addEventListener("DOMContentLoaded", function () {
    /**
     * obteniendo el elemento canvas con el id="miGrafico".
     * La función getContext('2d') devuelve el contexto del canvas en 2D, lo cual es necesario para dibujar en él.
     *
     * ——— GRÁFICO DE BARRAS: Pedidos por mes ———
     */
    let ctx = document.getElementById("miGrafico").getContext("2d");
    if (ctx) {
        //Se obtiene los datos de la BBDD
        fetch("/informes/pedidos")
            .then((response) => response.json())
            .then((data) => {
                // Crear el gráfico con los datos obtenidos
                new Chart(ctx, {
                    type: "bar", // Tipo de gráfico (puede ser 'bar', 'line', etc.)
                    data: {
                        labels: data.labels, // Meses
                        datasets: [
                            {
                                label: "Pedidos", //(Aparece en la Leyenda del gráfico)
                                data: data.data, // Datos de cantidad de pedidos
                                backgroundColor: "rgba(54, 162, 235, 0.5)",
                                borderColor: "rgba(54, 162, 235, 1)",
                                borderWidth: 1,
                            },
                        ],
                    },
                });
            })
            .catch((error) =>
                console.error("Error al obtener los datos:", error)
            );
    }

    // ——— GRÁFICO DOUGHNUT: Productos por categoría ———
    let ctxCategorias = document
        .getElementById("graficoCategorias")
        ?.getContext("2d");
    if (ctxCategorias) {
        fetch("/informes/categorias")
            .then((res) => res.json())
            .then((data) => {
                new Chart(ctxCategorias, {
                    type: "doughnut",
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: "Productos Vendidos",
                                data: data.data,
                                backgroundColor: [
                                    "rgba(255, 99, 132, 0.6)",
                                    "rgba(54, 162, 235, 0.6)",
                                    "rgba(255, 206, 86, 0.6)",
                                    "rgba(75, 192, 192, 0.6)",
                                    "rgba(153, 102, 255, 0.6)",
                                    "rgba(255, 159, 64, 0.6)",
                                ],
                                borderColor: "#fff",
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: "right" },
                        },
                    },
                });
            })
            .catch((e) => console.error("Error al obtener categorías:", e));
    }

    // 3) Top 10 Productos más vendidos (horizontal bar)
    const topCanvas = document.getElementById("topProductsChart");
    if (topCanvas) {
        fetch("/informes/productos/top")
            .then(res => res.json())
            .then(json => {
                console.log('topProducts', json.labels, json.data);

                new Chart(topCanvas.getContext("2d"), {
                    type: "bar",
                    data: {
                        labels: json.labels,
                        datasets: [
                            {
                                label: "Unidades vendidas",
                                data: json.data,
                                backgroundColor: "rgba(255,159,64,0.6)",
                                borderColor: "rgba(255,159,64,1)",
                                borderWidth: 1,
                                barThickness: 20,    // altura fija para cada barra
                                maxBarThickness: 25  // y un tope
                            }]
                    },
                    options: {
                        indexAxis: "y", // barras horizontales
                        scales: { x: { beginAtZero: true } },
                        plugins: { legend: { display: false } },
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                });
            })
            .catch(console.error);
    }
});
