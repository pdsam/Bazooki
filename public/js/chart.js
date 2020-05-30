let address = "/api/auctions/bids/50";

let request = new XMLHttpRequest();
request.open("GET", address, true);
request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

request.addEventListener("load", () => {
  response = JSON.parse(request.responseText);
  buildChart(response);
});
request.send();

function buildChart(response) {
    let data = []
  for (let i = 0; i < response.length; i++) {
    let aux = response[i];
    data.push({t:new Date(aux["time"]), y:aux["amount"]});
  }
  console.log(data)
  var ctx = document.getElementById("chart");
  let myChart = new Chart(ctx, {
    type: "line",
    data: {
        datasets: [{
          label: 'Price',
          data: data,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
    options: {
        scales: {
          xAxes: [{
            type: 'time'
          }]
        }
      }
  });
}
