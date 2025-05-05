import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
    // 2)chart de categorías
    const catCanvas = document.getElementById("categoriesChart");
    if (catCanvas) {
        const catData = JSON.parse(catCanvas.dataset.categories);
        new Chart(catCanvas.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: catData.labels,
                datasets: [
                    {
                        label: "Productos",
                        data: catData.data,
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4BC0C0",
                            "#9966FF",
                            "#FF9F40",
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
    }
});