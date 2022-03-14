var coinInput = document.getElementById('ccalcul');
var mmkInput = document.getElementById('mmkcalcul');
var coinRate = document.getElementById('coinratedata');
var coinChargeinput= document.getElementById('coinChargeinput');
var fileimginput=document.getElementById('formFile');
var reset= document.getElementById('reset');
var error=document.getElementById('errorBox');
var aftercoinSum=0;
var aftermmkSum=0;

coinInput.addEventListener("keyup" , function (){
    aftercoinSum = coinInput.value * coinRate.innerHTML;
    mmkInput.value= aftercoinSum;
    coinChargeinput.value=coinInput.value; 
})
coinChargeinput.addEventListener("keyup" , function (){
    aftercoinSum = coinChargeinput.value * coinRate.innerHTML;
    mmkInput.value= aftercoinSum;
    coinInput.value=coinChargeinput.value; 
})

mmkInput.addEventListener("keyup" , function (){
    aftermmkSum = mmkInput.value/coinRate.innerHTML;
    coinInput.value = aftermmkSum;
    coinChargeinput.value=coinInput.value; 
})
reset.addEventListener("click" , function (){
    coinChargeinput.value="";
    coinInput.value="";
    mmkInput.value="";  
    fileimginput.value="";

})
