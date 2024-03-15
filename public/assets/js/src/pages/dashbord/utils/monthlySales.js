import "../../../../lib/chart.js";

export default () => {
    const monthlySales = document.getElementById('monthlySales');
    const selectSalesDate = document.getElementById('selectSalesDate');
    const salesSummary = JSON.parse(monthlySales.dataset.salesSummary);

    const salesData = {
        annualSales: {
            value: salesSummary.annualSales,
            label: null
        },
        monthlySales: {
            value: salesSummary.monthlySales,
            label: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        dailySales: {
            value: salesSummary.dailySales,
            label: null
        }
    };

    const salesChart = new Chart(monthlySales, {
        type: 'bar',
        data: {
            labels: salesData.monthlySales.label,
            datasets: [
                { label: 'Sales', data: Object.values(salesData.monthlySales.value) , borderWidth: 1 },
            ]
        }
    });

    selectSalesDate.addEventListener('change', event => {
        const sale = salesData[event.target.value];
        if(sale) {
            salesChart.data.labels = sale.label || Object.keys(sale.value);
            salesChart.data.datasets[0].data = Object.values(sale.value);
            salesChart.update();
        }
    })
}