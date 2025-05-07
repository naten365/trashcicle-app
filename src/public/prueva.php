<div class="main-content">
    <div class="div-contend-pane-general">
        <div class="content-header">
            <h1>Panel de Energía</h1>
            <button class="btn animated" onclick="window.location.href='Tienda.php'">Ver Estadísticas</button>
        </div>
        
        <!-- Energy Dashboard -->
        <div class="energy-dashboard" style="display: none;">
            <h2>Tu Producción Energética</h2>
            <p>Visualiza tu contribución a la energía renovable a través del tiempo</p>
            
            <div class="energy-chart-container">
                <canvas id="energyChart"></canvas>
            </div>
            
            <div class="energy-highlights">
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2L3 14h9l-1 8 10-16h-9l1-4z"></path>
                        </svg>
                    </div>
                    <div class="highlight-content">
                        <h3>45 kWh</h3>
                        <p>Energía total generada</p>
                    </div>
                </div>
                
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3v12"></path>
                            <path d="M18 9v6"></path>
                            <path d="M6 15h12"></path>
                            <path d="M12 3v6"></path>
                            <path d="M12 15v6"></path>
                        </svg>
                    </div>
                    <div class="highlight-content">
                        <h3>+27%</h3>
                        <p>Incremento mensual</p>
                    </div>
                </div>
                
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#7ed957" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                    </div>
                    <div class="highlight-content">
                        <h3>8 kWh</h3>
                        <p>Meta semanal</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Energy Distribution -->
        <div class="energy-distribution">
            <h2 class="section-title">Distribución de Energía</h2>
            
            <div class="distribution-container">
                <div class="distribution-chart">
                    <canvas id="distributionChart"></canvas>
                </div>
                <div class="distribution-info">
                    <div class="distribution-item">
                        <div class="distribution-color" style="background-color: #7ed957;"></div>
                        <div class="distribution-label">Orgánicos (45%)</div>
                    </div>
                    <div class="distribution-item">
                        <div class="distribution-color" style="background-color: #52b788;"></div>
                        <div class="distribution-label">Plásticos (25%)</div>
                    </div>
                    <div class="distribution-item">
                        <div class="distribution-color" style="background-color: #40916c;"></div>
                        <div class="distribution-label">Papel (20%)</div>
                    </div>
                    <div class="distribution-item">
                        <div class="distribution-color" style="background-color: #2d6a4f;"></div>
                        <div class="distribution-label">Otros (10%)</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Energy Forecast -->
        <div class="energy-forecast">
            <h2 class="section-title">Proyección de Impacto</h2>
            <p>Basado en tu ritmo actual de reciclaje</p>
            
            <div class="forecast-stats">
                <div class="forecast-stat-card">
                    <h3>120 kWh</h3>
                    <p>Proyección a 3 meses</p>
                </div>
                <div class="forecast-stat-card">
                    <h3>85 kg</h3>
                    <p>CO₂ evitado proyectado</p>
                </div>
                <div class="forecast-stat-card">
                    <h3>42</h3>
                    <p>Árboles equivalentes</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base styles */
.main-content {
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #e0e0e0;
    background-color: #121212;
    border-radius: 12px;
}

.div-contend-pane-general {
    max-width: 1200px;
    margin: 0 auto;
}

/* Header styles */
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid #2a2a2a;
}

.content-header h1 {
    font-size: 2.2rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0;
}

.btn {
    background-color: #7ed957;
    color: #121212;
    border: none;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn.animated:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(126, 217, 87, 0.3);
}

/* Energy Dashboard */
.energy-dashboard {
    background-color: #1e2a23;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
}

.energy-dashboard h2 {
    font-size: 1.8rem;
    color: #ffffff;
    margin-top: 0;
    margin-bottom: 10px;
}

.energy-dashboard p {
    color: #b0b0b0;
    margin-bottom: 25px;
}

.energy-chart-container {
    height: 300px;
    margin-bottom: 30px;
    position: relative;
    background-color: #17211c;
    border-radius: 8px;
    padding: 15px;
}

.energy-highlights {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.highlight-card {
    background-color: #1a1a1a;
    border-radius: 10px;
    padding: 20px;
    flex: 1;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.highlight-card:hover {
    transform: translateY(-5px);
    background-color: #212121;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.highlight-icon {
    background-color: rgba(126, 217, 87, 0.1);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.highlight-icon svg {
    width: 24px;
    height: 24px;
}

.highlight-content h3 {
    font-size: 1.6rem;
    color: #7ed957;
    margin: 0;
    margin-bottom: 5px;
}

.highlight-content p {
    color: #b0b0b0;
    margin: 0;
    font-size: 0.9rem;
}

/* Energy Distribution */
.energy-distribution {
    background-color: #1a1a1a;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
}

.section-title {
    font-size: 1.6rem;
    color: #ffffff;
    margin-top: 0;
    margin-bottom: 20px;
}

.distribution-container {
    display: flex;
    align-items: center;
    gap: 30px;
}

.distribution-chart {
    flex: 1;
    height: 220px;
    background-color: #212121;
    border-radius: 8px;
    padding: 15px;
}

.distribution-info {
    flex: 1;
}

.distribution-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.distribution-color {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    margin-right: 12px;
}

.distribution-label {
    color: #d0d0d0;
    font-size: 1rem;
}

/* Energy Forecast */
.energy-forecast {
    background-color: #1a1a1a;
    border-radius: 12px;
    padding: 25px;
}

.energy-forecast p {
    color: #b0b0b0;
    margin-top: -10px;
    margin-bottom: 25px;
}

.forecast-stats {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.forecast-stat-card {
    background-color: #232323;
    border-radius: 10px;
    padding: 20px;
    flex: 1;
    text-align: center;
    transition: all 0.3s ease;
}

.forecast-stat-card:hover {
    background-color: #2a2a2a;
    transform: scale(1.03);
}

.forecast-stat-card h3 {
    font-size: 1.8rem;
    color: #7ed957;
    margin: 0;
    margin-bottom: 10px;
}

.forecast-stat-card p {
    color: #b0b0b0;
    margin: 0;
    font-size: 0.9rem;
}

/* Scripts for Charts */
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Data for energy production chart
const energyData = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
    datasets: [{
        label: 'Energía Generada (kWh)',
        data: [5, 8, 12, 9, 11, 45],
        backgroundColor: 'rgba(126, 217, 87, 0.2)',
        borderColor: '#7ed957',
        borderWidth: 2,
        tension: 0.4,
        pointBackgroundColor: '#7ed957',
        pointBorderColor: '#121212',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 8,
        fill: true
    }]
};

// Data for distribution chart
const distributionData = {
    labels: ['Orgánicos', 'Plásticos', 'Papel', 'Otros'],
    datasets: [{
        data: [45, 25, 20, 10],
        backgroundColor: ['#7ed957', '#52b788', '#40916c', '#2d6a4f'],
        borderWidth: 0,
        borderRadius: 5,
    }]
};

// Initialize charts when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Line chart for energy production
    const energyCtx = document.getElementById('energyChart').getContext('2d');
    const energyChart = new Chart(energyCtx, {
        type: 'line',
        data: energyData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                    },
                    ticks: {
                        color: '#b0b0b0'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                    },
                    ticks: {
                        color: '#b0b0b0'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1a1a1a',
                    titleColor: '#ffffff',
                    bodyColor: '#e0e0e0',
                    borderColor: '#7ed957',
                    borderWidth: 1,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return `${context.parsed.y} kWh generados`;
                        }
                    }
                }
            }
        }
    });
    
    // Pie chart for energy distribution
    const distributionCtx = document.getElementById('distributionChart').getContext('2d');
    const distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: distributionData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1a1a1a',
                    titleColor: '#ffffff',
                    bodyColor: '#e0e0e0',
                    borderColor: '#7ed957',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed}%`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
    
    // Function to update charts with new data
    window.updateEnergyData = function(newData) {
        // Update energy production chart
        energyChart.data.labels = newData.labels;
        energyChart.data.datasets[0].data = newData.values;
        energyChart.update();
        
        // Update distribution chart if needed
        distributionChart.data.datasets[0].data = newData.distribution;
        distributionChart.update();
        
        // Update stats
        document.querySelector('.highlight-card:nth-child(1) h3').textContent = `${newData.totalEnergy} kWh`;
        document.querySelector('.highlight-card:nth-child(2) h3').textContent = `${newData.growth}%`;
        document.querySelector('.highlight-card:nth-child(3) h3').textContent = `${newData.weeklyGoal} kWh`;
    };
});
</script>