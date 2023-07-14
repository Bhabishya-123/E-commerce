function closeTog() {
    console.log('called')
    var target2 = document.getElementById('login');
    console.log(target2)

      target2.classList.add('hide');
  }
function elementVisibility() {
      console.log('called')

    var target = document.getElementById('login');
    if (target.classList.contains('hide')) {
      target.classList.remove('hide');
    } else {
      target.classList.add('hide');
    }
  }
