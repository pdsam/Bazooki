/* globals Chart:false, feather:false */

let ctx = null;
let myChart = null;
let dirtyWorker = null;

(function createChart(workerUrl) {
  'use strict'

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
      ],
      datasets: [{
        data: [
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  });

    window.setInterval(function(){
            fetch("/api/sales")
                .then((response) =>{
                    return response.json();
            })
            .then((jsonResponse) =>{
                //TODO seperate in lists and actually update
                myChart.data.datasets = [jsonResponse];
                myChart.update();
            });
    }, 5000);
}())

