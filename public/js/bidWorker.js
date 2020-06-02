let adress = ""

function compare( a, b ) {
    if ( a['amount'] < b['amount'] ){
      return -1;
    }
    if ( a['amount'] > b['amount'] ){
      return 1;
    }
    return 0;
  }
  


function getBids(){
    let request = new XMLHttpRequest();
        request.open("GET",adress , true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        
        request.addEventListener("load",() =>{
            let res = JSON.parse(request.responseText);
            if(res.length != 0){
                res = res.sort(compare)
                postMessage(res[0]['amount'])
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
