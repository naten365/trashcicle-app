//Funcion de la grafica> 

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
