let address = '/api/auctions/bids/' + window.location.href.match("[0-9]+$")[0];



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
  //console.log(data)
  var ctx = document.getElementById("chart");
  let myChart = new Chart(ctx, {
    type: "line",
    data: {
        datasets: [{
          label: 'Price',
          data: data,
          backgroundColor: [
            'rgba(128, 25, 128,0.5)',
          ],
          borderColor: [
            'rgba(128, 25, 128,0.5)',
          ],
          borderWidth: 1
        }]
      },
    options: {
      bezierCurve: false,
        scales: {
          xAxes: [{
            type: 'time'
          }]
        }
      }
  });
}
