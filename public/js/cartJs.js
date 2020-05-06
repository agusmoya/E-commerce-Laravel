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

  //JS PARA REGISTER USER
  //TRAIGO PROVINCIAS DE ARGENTINA PARA REGISTRACION DE USER
  fetch('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre')
  .then(function(data) {
    return data.json();
  }).then(function(dataProvincias) {
    var arrayProvincias = dataProvincias.provincias.sort(function(a, b) {
      return 0;
    });
    if (document.getElementById('provincesAPI')) {
      let selectProvincias = document.getElementById('provincesAPI');
      var option = document.createElement('option');

      for (var provincia of arrayProvincias) {
        selectProvincias.innerHTML += `<option value="${provincia.nombre}"> ${provincia.nombre} </option>`
      }

      // @foreach ($generos as $genero)
      //         <option value="{{$genero->id}}" {{$genero->id == $pelicula->genre_id ? "selected" : ""}}>{{$genero->name}}</option>
      //       @endforeach
    }
  });

  //SI SE ENCUENTRA EL FORM DE REGISTRACION Y EL SELECT DE LAS PROVINCIAS (PARA QUE NO LANCE ERROR EN OTRAS PAGINAS)
  if (document.getElementById('formRegister') && document.getElementById('provincesAPI')) {
    var selectProv = document.getElementById('provincesAPI');
    var myForm = document.getElementById('formRegister');

    myForm.addEventListener('submit', function(event){
      if (selectProv.options[selectProv.selectedIndex].value === '') {
        event.preventDefault();
        var errorProv = document.querySelector('.provHelp');
        if(errorProv){
          errorProv.innerText = 'You must select a province.';
        }
      }
    });

    var myForm = document.getElementById('formRegister');
    var elementsMyForm = Array.from(myForm.elements);
    var errorProv = document.querySelector('.provHelp');
    elementsMyForm.pop();
    for (var element of elementsMyForm) {
      element.addEventListener('change', function(event){
        if (selectProv.options[selectProv.selectedIndex].value === '') {
          event.preventDefault();

          if(errorProv){
            errorProv.innerText = 'This field is required.';
          }
        } else {
          errorProv.innerText = '';
        }

        var alert = document.getElementById('error_' + this.getAttribute('name'));
        if (alert) {
          if (this.value.trim() == "") {
            alert.innerText = 'This field is required.';
            alert.style.color="red";
          }
          if(this.value.trim() !== "") {
            alert.innerText = '';
          }
        }
      });
    }

    //cambiamos el nombre del archivo que se selecciona
    if (document.getElementById('iptFileUpload')) {
      var inputFile = document.getElementById('iptFileUpload');
      inputFile.addEventListener('change', function(){
        if (document.getElementById('iptFileUpload').files[0]) {
          var contInputFile = document.getElementById('iptFileUpload').files[0].name;
          console.log('hola');
          var txtInputFile = document.getElementById('lblFileUpload');
          console.log(txtInputFile.firstChild.data);
          txtInputFile.firstChild.data = contInputFile;
        }
      });
    }
  }
  //JS PARA REGISTER USER

  /* **** VALIDACIONES DE CRUD Trademarks **** */
  /* Tabla */
  /*DELETE*/
  if (document.getElementById('btnDeleteTrademark')) {
    var btnsDeleteTrademark = Array.from(document.querySelectorAll('td #btnDeleteTrademark'));
    for (var btn of btnsDeleteTrademark) {
      btn.addEventListener('click', function(event){
        event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "you are about to DELETE the Trademark...",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e43f5a',
          cancelButtonColor: '#393e46',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            this.parentElement.submit();
          }
        });

      });
    }
  }
  /*DELETE*/
  /* Tabla */

  /* Form Create and update*/
  if (document.getElementById('name_trademark')) {
    var nameTrademarkIpt = document.getElementById('name_trademark');
    var alertJsNameTrademark = document.getElementById('alertJsNameTrademark');
    nameTrademarkIpt.addEventListener('blur', function(){
      if (this.value.trim() === '') {
        alertJsNameTrademark.childNodes[1].innerText = 'This field is required.';
      } else {
        alertJsNameTrademark.childNodes[1].innerText = '';
      }
    });
    var btnRegisterTrademark = document.querySelector('[name="register_trademark"]');
    btnRegisterTrademark.addEventListener('click', function(event){
      if (nameTrademarkIpt.value.trim() === ''){
        event.preventDefault();
        alertJsNameTrademark.childNodes[1].innerText = 'This field is required.';
      } else {
        event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "you are about to REGISTER the Trademark...",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e43f5a',
          cancelButtonColor: '#393e46',
          confirmButtonText: 'Yes, register it!'
        }).then((result) => {
          if (result.value) {
            this.parentElement.submit();
          }
        });
      }
    }
  );

}
/* Form Create and update*/
/* **** VALIDACIONES DE CRUD Trademark **** */

/* **** VALIDACIONES DE CRUD Category **** */
/* Form Create and update*/
if (document.getElementById('name_category')) {
  var nameCategoryIpt = document.getElementById('name_category');
      nameCategoryIpt.addEventListener('blur', function(){
          var alertJsNameCategory = document.getElementById('alertJsNameCategory');
          if (this.value.trim() === '') {
            alertJsNameCategory.childNodes[1].innerText = 'This field is required.';
          } else {
            alertJsNameCategory.childNodes[1].innerText = '';
          }
      });

var btnRegisterCategory = document.querySelector('[name="register_category"]');
      btnRegisterCategory.addEventListener('click', function(event){
                if (nameCategoryIpt.value.trim() === ''){
                  event.preventDefault();
                  alertJsNameCategory.childNodes[1].innerText = 'This field is required.';
                } else {
                      event.preventDefault();
                      Swal.fire({
                        title: 'Are you sure?',
                        text: "you are about to REGISTER the Category...",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e43f5a',
                        cancelButtonColor: '#393e46',
                        confirmButtonText: 'Yes, register it!'
                      }).then((result) => {
                            if (result.value) {
                              this.parentElement.submit();
                            }
                      });
                }

      });

}
/* Form Create and update*/

/* Tabla */
/*DELETE*/
if (document.getElementById('btnDeleteCategory')) {
    var btnsDeleteCategory = Array.from(document.querySelectorAll('td #btnDeleteCategory'));
        for (var btn of btnsDeleteCategory) {
              btn.addEventListener('click', function(event){
                event.preventDefault();
                    Swal.fire({
                      title: 'Are you sure?',
                      text: "you are about to DELETE the Category...",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#e43f5a',
                      cancelButtonColor: '#393e46',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                      if (result.value) {
                        this.parentElement.submit();
                      }
                    });

              });
        }
}
/*DELETE*/
/* Tabla */
/* **** VALIDACIONES DE CRUD Category **** */

/* **** VALIDACIONES DE CRUD Category/Trademark **** */
/* Tabla */
/*DELETE*/
if (document.querySelector('[name="btnDeleteRelationship"]')) {
  var btnsDeleteCategory = Array.from(document.querySelectorAll('[name="btnDeleteRelationship"]'));
  for (var btn of btnsDeleteCategory) {
    btn.addEventListener('click', function(event){
      event.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "you are about to DELETE the Relationship...",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e43f5a',
        cancelButtonColor: '#393e46',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          this.parentElement.submit();
        }
      });

    });
  }
}
/*DELETE*/
/* Tabla */

/* Form Select Trademark */
if (document.getElementById('selectTrademarks')) {
  var selectTrademarks = document.getElementById('selectTrademarks');
  var alertJsSelectTrademark = document.getElementById('alertJsSelectTrademark');
  var btnRegisterCategoryTrademark = document.querySelector('[name="registerCategoryTrademark"]');

  selectTrademarks.addEventListener("change", function(){
    if (this.options[this.selectedIndex].value == '') {
      alertJsSelectTrademark.childNodes[1].innerText = 'This field is required';
    } else {
      alertJsSelectTrademark.childNodes[1].innerText = '';
    }
  });

}
/* Form Select Trademark */

/* Form Select Category */
if (document.getElementById('selectCategories')) {
  var selectCategories = document.getElementById('selectCategories');
  var alertJsSelectCategory = document.getElementById('alertJsSelectCategory');
  var btnRegisterCategoryTrademark = document.querySelector('[name="registerCategoryTrademark"]');

  selectCategories.addEventListener("change", function(){
    if (this.options[this.selectedIndex].value == '') {
      alertJsSelectCategory.childNodes[1].innerText = 'This field is required';
    } else {
      alertJsSelectCategory.childNodes[1].innerText = '';
    }
  });

}
/* Form Select Category */
if (document.getElementById('selectCategories') || document.getElementById('selectTrademarks')) {
        btnRegisterCategoryTrademark.addEventListener('click', function(event){
          event.preventDefault();
          if (selectCategories.selectedIndex == 0 || selectTrademarks.selectedIndex == 0) {
            event.preventDefault();
            var alertEmptySubmit = document.getElementById('alertEmptySubmit');
            alertEmptySubmit.childNodes[1].innerText = 'You must select trademark and category.';
          } else {
            Swal.fire({
              title: 'Are you sure?',
              text: "You are about to REGISTER the relationship...",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#e43f5a',
              cancelButtonColor: '#393e46',
              confirmButtonText: 'Yes, register it!'
            }).then((result) => {
              if (result.value) {
                this.parentElement.submit();
              }
            });
          }
        }
);

}
/* **** VALIDACIONES DE CRUD Category/Trademark **** */

/* **** VALIDACIONES DE CRUD Products **** */
if (document.querySelector('[name="register_product"]')) {
  /* Validar boton submit (deshabilitado para ver demas validaciones)*/
  var formProd = document.querySelector('[name="register_product"]');

  /*** vista registro ***/
  var arrayFormProd = Array.from(formProd.elements); //quitamos ulitmo elemento, el boton.
  arrayFormProd.pop();
  arrayFormProd.forEach(item => {
    item.addEventListener(
      'blur', function(){
        if (this.value == '') {
          item.parentElement.childNodes[5].childNodes[1].innerText='Please, complete this field.';
        } else {
          item.parentElement.childNodes[5].childNodes[1].innerText='';
        }
      }
    );
  });

  formProd.addEventListener('submit', function(event){
    event.preventDefault();
        Swal.fire({
          title: 'Are you sure?',
          text: "You are about to CREATE the product...",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e43f5a',
          cancelButtonColor: '#393e46',
          confirmButtonText: 'Yes, create it!'
        }).then((result) => {
          if (result.value) {
            this.submit();
          }
        });
  });
}
/*** vista registro ***/

/*** vista edit ***/
if (document.querySelector('[name="update_product"]')) {
  var formProd = document.querySelector('[name="update_product"]');
  var arrayFormProd = Array.from(formProd.elements); //quitamos ulitmo elemento, el boton.
  arrayFormProd.pop();
  arrayFormProd.forEach(item => {
    item.addEventListener('blur', function(){
      if (this.value == '') {
        this.nextElementSibling.childNodes[1].innerText='Please, complete this field.';
      } else {
        this.nextElementSibling.childNodes[1].innerText='';
      }
    }
  );

});

formProd.addEventListener('submit', function(event){
  event.preventDefault();
  var flag= true;
      for (var item of arrayFormProd) {
        if (item.value=='' && item.getAttribute('name')!='photo') {
          flag=false;
        }
      }

      if (flag) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You are about to Update the product...",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e43f5a',
          cancelButtonColor: '#393e46',
          confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
          if (result.value) {
            this.submit();
          }
        });

      } else {
        var alertJsBtnUpdateProd = document.getElementById('alertJsBtnUpdateProd');
        alertJsBtnUpdateProd.childNodes[1].innerText = 'You must complete all fields!'
      }

});

}
/*** vista edit ***/

/*tabla: delete*/
if (document.querySelector('[name="btnDeleteProd"]')) {
  var btnsDeleteProd = Array.from(document.querySelectorAll('[name="btnDeleteProd"]'));
  for (var btn of btnsDeleteProd) {
    btn.addEventListener('click', function(event){
      event.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "you are about to DELETE the Product...",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e43f5a',
        cancelButtonColor: '#393e46',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.value) {
            this.parentElement.submit();
          }
      });

    });
  }
}
/*tabla: delete*/

/* **** VALIDACIONES DE CRUD Products **** */

});
