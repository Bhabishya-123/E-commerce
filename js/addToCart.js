
function addToCart() {
  var quantityInput = document.getElementById("quantity");
var quantity = parseInt(quantityInput.value);
  if ((quantity >= 1) && (quantity <= 5)) {
    alert("Products has been added to your cart.");  
  } 
}

function incQuantity() {
  var quantityInput = document.getElementById("quantity");
var quantity = parseInt(quantityInput.value);
  if (quantity < 5) {
    quantityInput.value = quantity + 1;
  } else {
    alert("You have reached the maximum quantity.");
  }
}

function decQuantity() {
  var quantityInput = document.getElementById("quantity");
var quantity = parseInt(quantityInput.value);
  if (quantity > 1) {
    quantityInput.value = quantity - 1;
  } else {
    alert("You have reached the minimum quantity.");
  }
}
