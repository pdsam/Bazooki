function getBids(){
    let request = new XMLHttpRequest();
        let id = window.location.href.split([0 - 9] * $)
        request.open("GET", "/api/auctions/bids/" + document.getElementById("aux-id").innerText, true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        
        request.addEventListener("load",() =>{
            const res = JSON.parse(request.responseText);
            if(res.size == 0){
                return
            }
                postMessage("FINISH WEB WORKER")
            
            


        })
        request.send()


    setTimeout("getBids()",3000)
}
getBids()