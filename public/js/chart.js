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
  let data = [];
  for (let i = 0; i < response.length; i++) {
    let aux = response[i];
    data.push([new Date(aux["time"]), aux["amount"]]);
  }
  var ctx = document.getElementById("chart");
  let myChart = new Chart(ctx, {
    type: "line",
    data: data,
  });
}
