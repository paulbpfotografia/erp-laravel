import Chart from 'chart.js/auto';

// Esperar a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', function () {
    /**
     * obteniendo el elemento canvas con el id="miGrafico".
     * La función getContext('2d') devuelve el contexto del canvas en 2D, lo cual es necesario para dibujar en él.
     */
    let ctx = document.getElementById('miGrafico').getContext('2d');

    //Se obtiene los datos de la BBDD
    fetch('/informes/pedidos')
        .then(response => response.json())
        .then(data => {
            // Crear el gráfico con los datos obtenidos
            new Chart(ctx, {
                type: 'bar', // Tipo de gráfico (puede ser 'bar', 'line', etc.)
                data: {
                    labels: data.labels, // Meses (Enero 2022, Febrero 2022, etc.)
                    datasets: [{
                        label: 'Pedidos', //(Aparece en la Leyenda del gráfico)
                        data: data.data, // Datos de cantidad de pedidos
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                }
            });
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});
