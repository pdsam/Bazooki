let start_time = document.getElementById("timer-start-time").textContent;
let duration = document.getElementById("timer-duration").textContent;
let output = document.getElementById("duration-place");
let t = start_time.split(/[- :]/);
let x = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]));
start_time = x.getTime();
let end_time = start_time + parseInt(duration) * 1000;

let f = setInterval(function () {
  let now = new Date().getTime();
  let distance = end_time - now - 3600000;
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);
  if(start_time > Date.now()){
	      output.innerHTML = "Starting at " + document.getElementById("timer-start-time").textContent;
    }
  else if (distance > 0) {
    if(days ==0){
      output.innerHTML =
      hours + "h " + minutes + "m " + seconds + "s ";
    }
    else{
    output.innerHTML =
      days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
    }
  } else {
    output.innerHTML = "Expired";
    document.getElementById("bid-button").disabled = true;
    clearInterval(f);
  }
}, 1000);


if (typeof Worker !== "undefined") {
  if (typeof w == "undefined") {
    w = new Worker("/js/bidWorker.js");
    w.postMessage(
      "/api/auctions/bids/" + window.location.href.match("[0-9]+$")[0]
    );
    //console.log("sending message");
    w.onmessage = function (event) {
      document.getElementById("price").innerHTML = "€" + event.data;
    };
  }
}
