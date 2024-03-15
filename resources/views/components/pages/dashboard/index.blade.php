<x-layouts.default-layout title="Dashboard">
    <x-utils.subheader
        title="Dashboard"
        :button="false"
    />
    <x-utils.content>
        <x-slot:body>
            <div class="w-100 d-flex flex-wrap justify-content-between">
                
                <div class="card small-card-width mb-3 mb-lg-0">
                    <h5 class="card-header">Sales of the day</h5>
                    <div class="card-body">
                      <h2>${{ $dailySales->currentDay()->abbreviate()->get() }}</h2>
                    </div>
                </div>

                <div class="card small-card-width mb-3 mb-lg-0">
                    <h5 class="card-header">Sales of the month</h5>
                    <div class="card-body">
                      <h2>${{ $monthlySales->currentMonth()->abbreviate()->get() }}</h2>
                    </div>
                </div>

                <div class="card small-card-width mb-3 mb-lg-0">
                    <h5 class="card-header">Sales of the year</h5>
                    <div class="card-body">
                      <h2>${{ $annualSales->currentYear()->abbreviate()->get() }}</h2>
                    </div>
                </div>

                <div class="card small-card-width mb-3 mb-lg-0">
                    <h5 class="card-header">Total Sales</h5>
                    <div class="card-body">
                      <h2>${{ $annualSales->sum()->abbreviate()->get() }}</h2>
                    </div>
                </div>

            </div>
            <div class="chart-width border p-3 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Sales</h5>
                    <select class="form-select w-auto" id="selectSalesDate">
                        <option value="dailySales">Days</option>
                        <option selected value="monthlySales">Months</option>
                        <option value="annualSales">Years</option>
                    </select>
                </div>
                <canvas id="monthlySales" data-sales-summary='{!! json_encode([
                    'annualSales' => $annualSales->get(),
                    'monthlySales' => $monthlySales->get(),
                    'dailySales' => $dailySales->get()
                ]) !!}'
                ></canvas>
            </div>
            <div class="chart-width border p-3 rounded">
                <h5>Top Selling Products</h5>
                <div class="w-100 d-flex justify-content-center">
                    <div class="w-50">
                        <canvas id="topSellingProducts" data-products='{!! json_encode($topSellingProducts) !!}'></canvas>
                    </div>
                </div>
            </div>
        </x-slot:body>
    </x-utils.content>
</x-layouts.default-layout>