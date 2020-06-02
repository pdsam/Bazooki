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
  if (distance > 0) {
    output.innerHTML =
      days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
  } else {
    output.innerHTML = "Expired";
    clearInterval(f);
  }
}, 1000);

$("#bid-form").submit(async (e) => {
  e.preventDefault();

  const form = $("#bid-form :input");

  const valArray = form.serializeArray();
  const id = valArray[1].value;

  const amount = await fetch(`/auctions/${id}/bid`, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": valArray[0].value,
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: form.serialize(),
  }).then((response) => {
    if (response.status >= 400 && response.status < 600) {
    }
    location.reload();
  });

  const val = await amount.text();
  $("#price").html(val);
});

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
