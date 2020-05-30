let adress = ""
let counter = 0

function getBids(){
    let request = new XMLHttpRequest();
        request.open("GET",adress , true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        
        request.addEventListener("load",() =>{
            const res = JSON.parse(request.responseText);
            if(res.size == 0){
                return
            }
                counter++;
                postMessage(counter)
            


        })
        request.send()


    setTimeout("getBids()",3000)
}

self.addEventListener("message",function(e){
    adress = e.data
    console.log("got message updating")
    getBids()
})