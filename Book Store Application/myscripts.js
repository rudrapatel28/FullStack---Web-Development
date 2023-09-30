function addToCart(button) {
  var bookSection = button.parentNode;
  var bookId = bookSection.querySelector(".book").innerText;
  var bookName = bookSection.querySelector(".name").innerText;
  var bookPrice = bookSection.querySelector(".price").innerText;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "add_to_cart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Book added to cart!");
    }
  };
  xhr.send("bookid=" + bookId + "&name=" + bookName + "&price=" + bookPrice);
}

function addToFavorites(button) {
  var bookSection = button.parentNode;
  var bookId = bookSection.querySelector(".book").textContent.trim();
  var bookName = bookSection.querySelector(".name").textContent.trim();
  var bookPrice = bookSection.querySelector(".price").textContent.trim();

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "add_to_favorites.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Book added to Favorites!");
    }
  };
  xhr.send("bookid=" + bookId + "&name=" + bookName + "&price=" + bookPrice);
}
