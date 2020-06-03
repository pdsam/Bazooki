/* globals Chart:false, feather:false */

let ctx = null;
let myChart = null;
let dirtyWorker = null;

(function createChart(workerUrl) {
  'use strict'

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
      ],
      datasets: [{
	      data: [],
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

	salesUpdater();
    window.setInterval(salesUpdater, 5000);
}())


function salesUpdater(){
            fetch("/api/sales")
                .then((response) =>{
                    return response.json();
            })
            .then((jsonResponse) =>{
		myChart.data.labels = jsonResponse.map((entry) => { return  entry.hour; });
		myChart.data.datasets[0].data = jsonResponse.map((entry) => { return entry.value; });
                myChart.update();

		table = document.getElementById("profitTable");
		table.innerHTML = '';

		jsonResponse.forEach( (entry) => {
			table.innerHTML += `<tr>
						<td>
				${entry.hour}
						</td>

						<td>
				${entry.value}
						</td>

						</tr>`
			

		});
            });
}
