//program to dropdown menu and close dropdown for electronics
   var element = document.querySelector('.electronics');
   var target = document.querySelector('#hide');
   element.addEventListener('click', function(){
    if(target.id != 'hide'){
        target.id='hide';
    }else{
     target.id='show';
    }
});

