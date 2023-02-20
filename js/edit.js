// long methods
// var element2 = document.querySelector('.edit_link');
// var target2 = document.querySelector('.profile_edit');
// element2.addEventListener('click', function(){
//  if(target2.className != 'profile_edit_show'){
//      target2.className='profile_edit_show';
//  }else{
//   target2.className='profile_edit';
//  }
// });

//easy method for hide and show class

var element2 =document.querySelector('#edit_link1');
element2.addEventListener('click', function(){
document.querySelector(".profile_edit").classList.toggle("show");
});
var element3 =document.querySelector('#edit_link2');
element3.addEventListener('click', function(){
document.querySelector(".address_edit").classList.toggle("show");
});
var element4 =document.querySelector('#edit_link3');
element4.addEventListener('click', function(){
document.querySelector(".contact_edit").classList.toggle("show");
});