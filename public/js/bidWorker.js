let adress = ""

function getBids(){
    let request = new XMLHttpRequest();
        request.open("GET",adress , true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        
        request.addEventListener("load",() =>{
            const res = JSON.parse(request.responseText);
            if(res.length != 0){
                postMessage(res[0]['amount'])//TODO
            }
            
            


        })
        request.send()


    setTimeout("getBids()",3000)
}

self.addEventListener("message",function(e){
    adress = e.data
    console.log("got message updating")
    getBids()
})