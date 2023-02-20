

//js for addcart scenario autoincreament
localStorage.setItem('number',0);
var numofitem = localStorage.getItem('number');
var element = document.querySelector('.btn2');
var target = document.querySelector('#cart');
element.addEventListener('click', function(){
    numofitem++;
      localStorage.setItem('number', numofitem);
      second();
});

function second() {
        target.innerHTML=localStorage.getItem('number');
}
setTimeout(second,100);
