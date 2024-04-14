var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Batal", "Selesai", "Proses"],
        datasets: [
            {
                data: [jumlah_batal, jumlah_selesai, jumlah_proses],
                backgroundColor: ["#dc3545", "#28a745", "#ffc107"],
                hoverBackgroundColor: ["#c82333", "#218838", "#e0a800"],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: false,
        },
        cutoutPercentage: 80,
    },
});
