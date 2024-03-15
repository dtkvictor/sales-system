import "../../../../lib/chart.js";

export default () => {
    const topSellingProducts = document.getElementById('topSellingProducts');
    const products = JSON.parse(topSellingProducts.dataset.products);

    new Chart(topSellingProducts, {
        type: 'pie',
        data: {
            labels: Object.keys(products),
            datasets: [
                { label: 'Products', data: Object.values(products), borderWidth: 1 }
            ]
        }
    });
}