window.addEventListener('load', function(){

  /*Levanto la varible se sessionStorage para recargar las ultimas
  modificaciones del usuario hechas en el carrito*/
if (document.querySelector('table tbody #rowItemCartId') &&
 JSON.parse(sessionStorage.getItem('array')) != null)
 {
  // var linkCartNav = document.getElementById('linkMyPurchase').style.display="none";

  var arrayRowsTable = Array.from(document.querySelectorAll('table tbody #rowItemCartId'));

  for ( var item of JSON.parse(sessionStorage.getItem('array')) ) {
        for (var row of arrayRowsTable) {
              if (item.id == row.dataset.itemId) {
                // row.children[3].childNodes[1].value = item.amount;
                // console.log(row.children[3].childNodes[1].value = item.amount);
                // row.children[4].childNodes[1].innerText = parseInt(row.children[2].childNodes[1].innerText) * item.amount;
                // console.log(row.children[3].childNodes[1].value);
              }
        }
  }
sessionStorage.removeItem('array')
}

  // myPurchase SHOPPING CART
  var spanTotal = document.getElementById('total');
  var subtotalPricesItems = Array.from(document.querySelectorAll('#subtotal'));

  var totalPriceCart = subtotalPricesItems.reduce((acu, elem)=>acu+parseInt(elem.innerText), 0)

  if ( spanTotal ) {
    spanTotal.innerText+=totalPriceCart;
  }

  /* esto es para loaded_product_preview */
  if (document.querySelector('#addToCart')) {
    var addToCart = document.querySelector('#addToCart');
        addToCart.addEventListener("click", function(e){
          // var productId = document.querySelector('[name="productId"]').value;
          var stockProd = parseInt(document.getElementById("stockProd").innerText);

          var selectAmount = document.querySelector('[name="amount"]').value;
              if (selectAmount > stockProd) {
                    e.preventDefault();
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Sorry, we do not have enough stock to add this product to the cart!',
                      footer: 'If you want, you can <a href="/homeHassen/availableProducts"> see others here...</a>'
                    });
              }
        });
  }
  /* esto es para loaded_product_preview */

/*ESTO ES PARA LA VISTA DE MY PURCHASE*/
  if (document.querySelector('td #amountItemCart')) {

    var itemsAmount = document.querySelectorAll('td #amountItemCart');
    var arrayItemsAmount = Array.from(itemsAmount);

    for (var itemAmount of arrayItemsAmount) {
      itemAmount.addEventListener('keyup', function(){
                if (parseInt(this.dataset.stock) < parseInt(this.value)) {
                              Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'We do not have the selected amount of the product!',
                                footer: 'If you want, you can <a href="/homeHassen/availableProducts"> see others here...</a>'
                              });
                              this.value = parseInt(this.dataset.stock);
                }
      });

      itemAmount.addEventListener('click', function(){
                if (parseInt(this.value) > parseInt(this.dataset.stock)) {
                              Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Ups, we do not have the selected amount of the product!',
                                footer: 'If you want, you can <a href="/homeHassen/availableProducts"> see others here...</a>'
                              });
                              this.value = parseInt(this.dataset.stock);
                }

      var amountsItems = Array.from(document.querySelectorAll('#amountItemCart'));
      var totalAmountCart = amountsItems.reduce((acu, elem) => acu + parseInt(elem.value), 0);

      /*modifico total y subtotal del carrito con cada click*/
      var spanTotal = document.getElementById('total');
      var subtotalPricesItems = Array.from(document.querySelectorAll('#subtotal'));
      for (var itemSubtotal of subtotalPricesItems) {
        if (itemSubtotal.dataset.itemId == this.dataset.itemId) {
          itemSubtotal.innerText = this.value * this.dataset.prodPrice;
        }
      }

      var totalPriceCart = subtotalPricesItems.reduce((acu, elem)=>acu+parseInt(elem.innerText), 0)
      spanTotal.innerText='Total: $' + totalPriceCart;

      updateTotalAmountCart(totalAmountCart);
      updateDetailsCart(this.parentElement.parentElement.querySelector('[name="itemId"]').value, this.value);
      });
  }
}
  /*ESTO ES PARA LA VISTA DE MY PURCHASE*/
  function updateTotalAmountCart(totalAmountCart){
    var linkCartNav = document.getElementById('linkMyPurchase');

    sessionStorage.setItem("totalAmountCart", totalAmountCart);
    linkCartNav.innerText = ' My Cart (' + sessionStorage.getItem("totalAmountCart") + ')';

    var dataTotalAmountCart = new FormData();
    dataTotalAmountCart.append('totalAmountCart', sessionStorage.getItem("totalAmountCart"));

   let header = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
   fetch('/shoppingCart/updateTotalAmountCart', {
     method: 'POST',
     body: dataTotalAmountCart,
     headers: {'X-CSRF-TOKEN': header} // Para enviar data via fetch
   })
   .then(response=>response.json())
   .then(data => {
     // console.log(data);
   })
   .catch();

  }

  function updateDetailsCart(itemId, itemAmount){
    var array = [];
    if (sessionStorage.getItem('array') != null) {
      array=JSON.parse(sessionStorage.getItem('array'));
    }

    var itemCart = new Object();
    itemCart.id = itemId;
    itemCart.amount = itemAmount;

    var flag = true;
    for (var item of array) {
      if (item.id == itemCart.id) {
        flag=false;
        item.amount = itemAmount;
      }
    }

    if (flag) {
      array.push(itemCart);
    }

    sessionStorage.setItem('array', JSON.stringify(array));

    var itemAmountCart = new FormData();
    itemAmountCart.append('itemAmountCart', itemCart.amount);
    itemAmountCart.append('itemId', itemCart.id);

    let header = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/shoppingCart/updateItemAmountCart', {
      method: 'POST',
      body: itemAmountCart,
      headers: {'X-CSRF-TOKEN': header} // Para enviar data via fetch
    })
    .then(response=>response.json())
    .then(data => {
      // console.log(data);
    })
    .catch();

  }


});
