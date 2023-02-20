//this will make confirm box and if true it will make href of element to logut.php for redirection
var element1 = document.getElementById("lg-btn");
element1.addEventListener("click", () => {
  var logout = confirm("Are you sure to logout?");
  if (logout) {
    element1.href = "logout.php"; //means if user click ok than only it will set logout href
  }
});
