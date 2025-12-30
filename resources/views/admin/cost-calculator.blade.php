@extends('layout')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center mb-6">
            <div class="sm:flex-auto">
                <h1 class="heading-title">Kalkulačka nákladů na 1 km</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                    Dynamický výpočet nákladů na provoz vozidla
                </p>
            </div>
        </div>

        <div class="divide-y divide-gray-900/10 dark:divide-white/10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-5 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Základní nastavení</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">
                        Pevné údaje pro výpočet nákladů.
                    </p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-2">
                                <label for="avg-speed" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Průměrná rychlost (km/h)</label>
                                <div class="mt-2">
                                    <input id="avg-speed"
                                           name="avg-speed"
                                           type="number"
                                           step="0.1"
                                           value="70"
                                           readonly
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="yearly-mileage" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Roční nájezd (km)</label>
                                <div class="mt-2">
                                    <input id="yearly-mileage"
                                           name="yearly-mileage"
                                           type="number"
                                           step="1000"
                                           value="50000"
                                           readonly
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="working-days" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Pracovních dní v roce</label>
                                <div class="mt-2">
                                    <input id="working-days"
                                           name="working-days"
                                           type="number"
                                           value="250"
                                           readonly
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Variabilní náklady</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">
                        Vyplňte aktuální hodnoty pro výpočet nákladů.
                    </p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="fuel-consumption" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Spotřeba paliva (l/100km)</label>
                                <div class="mt-2">
                                    <input id="fuel-consumption"
                                           type="number"
                                           step="0.1"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="fuel-price" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Cena paliva (Kč/l)</label>
                                <div class="mt-2">
                                    <input id="fuel-price"
                                           type="number"
                                           step="0.1"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="driver-wage" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Mzda řidiče (Kč/h)</label>
                                <div class="mt-2">
                                    <input id="driver-wage"
                                           type="number"
                                           step="1"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="insurance" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Pojištění (Kč/měsíc)</label>
                                <div class="mt-2">
                                    <input id="insurance"
                                           type="number"
                                           step="1"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="toll" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Mýto (Kč/den)</label>
                                <div class="mt-2">
                                    <input id="toll"
                                           type="number"
                                           step="1"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="other-costs" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Ostatní náklady (Kč/rok)</label>
                                <div class="mt-2">
                                    <input id="other-costs"
                                           type="number"
                                           step="100"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="margin" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Marže (Kč/km)</label>
                                <div class="mt-2">
                                    <input id="margin"
                                           type="number"
                                           step="0.1"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-8 py-10 md:grid-cols-3">
                <div class="px-4 sm:px-0">
                    <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Výsledek kalkulace</h2>
                    <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Celkové náklady na 1 km jízdy včetně všech položek.</p>
                </div>

                <div class="bg-white shadow-xs outline outline-gray-900/5 sm:rounded-xl md:col-span-2 dark:bg-[#212121] dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="max-w-2xl space-y-6">
                            <!-- Cost Breakdown -->
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Palivo na 1 km</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="fuel-cost-per-km">0.00 Kč</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Mzda řidiče na 1 km</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="wage-cost-per-km">0.00 Kč</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Pojištění na 1 km</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="insurance-cost-per-km">0.00 Kč</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Mýto na 1 km</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="toll-cost-per-km">0.00 Kč</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Ostatní náklady na 1 km</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="other-cost-per-km">0.00 Kč</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Marže</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white" id="margin-per-km">0.00 Kč</span>
                                </div>
                            </div>

                            <!-- Total Cost -->
                            <div class="pt-6 border-t-2 border-gray-300 dark:border-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Celková cena za 1 km</span>
                                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400" id="total-cost-per-km">0.00 Kč</span>
                                </div>
                            </div>

                            <!-- Annual Summary -->
                            <div class="mt-6 p-4 bg-gray-50 dark:bg-primary-800/20 dark:border dark:border-primary rounded-lg">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Roční přehled</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Celkové roční náklady</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white" id="total-annual-cost">0.00 Kč</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Roční příjem (s marží)</span>
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400" id="total-annual-revenue">0.00 Kč</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calculator state
        const calculator = {
            // Constants
            avgSpeed: 70,
            yearlyMileage: 50000,
            workingDays: 250,

            // Variables
            fuelConsumption: 0,
            fuelPrice: 0,
            driverWage: 0,
            insurance: 0,
            toll: 0,
            otherCosts: 0,
            margin: 0,

            // Calculated values
            fuelCostPerKm: 0,
            wageCostPerKm: 0,
            insuranceCostPerKm: 0,
            tollCostPerKm: 0,
            otherCostPerKm: 0,
            totalCostPerKm: 0,
            totalAnnualCost: 0,
            totalAnnualRevenue: 0,

            calculate() {
                // Fuel cost per km: (consumption / 100) * price
                this.fuelCostPerKm = (this.fuelConsumption / 100) * this.fuelPrice;

                // Wage cost per km: (wage per hour / avg speed)
                this.wageCostPerKm = this.avgSpeed > 0 ? this.driverWage / this.avgSpeed : 0;

                // Insurance cost per km: (monthly insurance * 12) / yearly mileage
                this.insuranceCostPerKm = this.yearlyMileage > 0 ? (this.insurance * 12) / this.yearlyMileage : 0;

                // Toll cost per km: (daily toll * working days) / yearly mileage
                this.tollCostPerKm = this.yearlyMileage > 0 ? (this.toll * this.workingDays) / this.yearlyMileage : 0;

                // Other costs per km: yearly other costs / yearly mileage
                this.otherCostPerKm = this.yearlyMileage > 0 ? this.otherCosts / this.yearlyMileage : 0;

                // Total cost per km (without margin)
                const baseCostPerKm = this.fuelCostPerKm + this.wageCostPerKm + this.insuranceCostPerKm +
                                     this.tollCostPerKm + this.otherCostPerKm;

                // Total cost per km (with margin)
                this.totalCostPerKm = baseCostPerKm + this.margin;

                // Annual calculations
                this.totalAnnualCost = baseCostPerKm * this.yearlyMileage;
                this.totalAnnualRevenue = this.totalCostPerKm * this.yearlyMileage;

                this.updateDisplay();
                this.saveData();
            },

            updateDisplay() {
                document.getElementById('fuel-cost-per-km').textContent = this.fuelCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('wage-cost-per-km').textContent = this.wageCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('insurance-cost-per-km').textContent = this.insuranceCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('toll-cost-per-km').textContent = this.tollCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('other-cost-per-km').textContent = this.otherCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('margin-per-km').textContent = this.margin.toFixed(2) + ' Kč';
                document.getElementById('total-cost-per-km').textContent = this.totalCostPerKm.toFixed(2) + ' Kč';
                document.getElementById('total-annual-cost').textContent = this.totalAnnualCost.toLocaleString('cs-CZ', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' Kč';
                document.getElementById('total-annual-revenue').textContent = this.totalAnnualRevenue.toLocaleString('cs-CZ', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ' Kč';
            },

            saveData() {
                const data = {
                    fuelConsumption: this.fuelConsumption,
                    fuelPrice: this.fuelPrice,
                    driverWage: this.driverWage,
                    insurance: this.insurance,
                    toll: this.toll,
                    otherCosts: this.otherCosts,
                    margin: this.margin
                };

                // Save to localStorage
                localStorage.setItem('costCalculatorData', JSON.stringify(data));

                // Save to server
                fetch('{{ route("admin.cost-calculator.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                }).catch(error => console.error('Error saving data:', error));
            },

            loadData() {
                // Try to load from localStorage first
                const localData = localStorage.getItem('costCalculatorData');
                if (localData) {
                    const data = JSON.parse(localData);
                    this.applyData(data);
                }

                // Then fetch from server (will override if available)
                fetch('{{ route("admin.cost-calculator.load") }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data && Object.keys(data).length > 0) {
                            this.applyData(data);
                        }
                    })
                    .catch(error => console.error('Error loading data:', error));
            },

            applyData(data) {
                this.fuelConsumption = parseFloat(data.fuelConsumption) || 0;
                this.fuelPrice = parseFloat(data.fuelPrice) || 0;
                this.driverWage = parseFloat(data.driverWage) || 0;
                this.insurance = parseFloat(data.insurance) || 0;
                this.toll = parseFloat(data.toll) || 0;
                this.otherCosts = parseFloat(data.otherCosts) || 0;
                this.margin = parseFloat(data.margin) || 0;

                // Update input fields
                document.getElementById('fuel-consumption').value = this.fuelConsumption || '';
                document.getElementById('fuel-price').value = this.fuelPrice || '';
                document.getElementById('driver-wage').value = this.driverWage || '';
                document.getElementById('insurance').value = this.insurance || '';
                document.getElementById('toll').value = this.toll || '';
                document.getElementById('other-costs').value = this.otherCosts || '';
                document.getElementById('margin').value = this.margin || '';

                this.calculate();
            }
        };

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved data
            calculator.loadData();

            // Add input event listeners
            const inputs = [
                'fuel-consumption',
                'fuel-price',
                'driver-wage',
                'insurance',
                'toll',
                'other-costs',
                'margin'
            ];

            inputs.forEach(id => {
                const element = document.getElementById(id);
                element.addEventListener('input', function() {
                    const value = parseFloat(this.value) || 0;

                    switch(id) {
                        case 'fuel-consumption':
                            calculator.fuelConsumption = value;
                            break;
                        case 'fuel-price':
                            calculator.fuelPrice = value;
                            break;
                        case 'driver-wage':
                            calculator.driverWage = value;
                            break;
                        case 'insurance':
                            calculator.insurance = value;
                            break;
                        case 'toll':
                            calculator.toll = value;
                            break;
                        case 'other-costs':
                            calculator.otherCosts = value;
                            break;
                        case 'margin':
                            calculator.margin = value;
                            break;
                    }

                    calculator.calculate();
                });
            });
        });
    </script>
@endsection
