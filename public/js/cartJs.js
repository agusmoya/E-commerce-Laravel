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
  /* Form Tabla Create and update*/
  if (document.getElementById('name_trademark')) {
    var nameTrademarkIpt = document.getElementById('name_trademark');
    var alertJsNameTrademark = document.getElementById('alertJsNameTrademark');
    nameTrademarkIpt.addEventListener('blur', function(){
      if (this.value.trim() === '') {
        alertJsNameTrademark.innerText = 'This field is required.';
      } else {
        alertJsNameTrademark.innerText = '';
      }
    });
    var btnRegisterTrademark = document.querySelector('[name="register_trademark"]');
    btnRegisterTrademark.addEventListener('click', function(event){
      if (nameTrademarkIpt.value.trim() === ''){
        event.preventDefault();
        alertJsNameTrademark.innerText = 'This field is required.';
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
            this.parentElement.parentElement.submit();
          }
        });
      }
    }
  );

}
/* Form Tabla Create and update*/
/* **** VALIDACIONES DE CRUD Trademark **** */

/* **** VALIDACIONES DE CRUD Category **** */
/* Form Create and update*/
if (document.getElementById('name_category')) {
  var nameCategoryIpt = document.getElementById('name_category');
      nameCategoryIpt.addEventListener('blur', function(){
          var alertJsNameCategory = document.getElementById('alertJsNameCategory');
          if (this.value.trim() === '') {
            alertJsNameCategory.innerText = 'This field is required.';
          } else {
            alertJsNameCategory.innerText = '';
          }
      });

var btnRegisterCategory = document.querySelector('[name="register_category"]');
      btnRegisterCategory.addEventListener('click', function(event){
                if (nameCategoryIpt.value.trim() === ''){
                  event.preventDefault();
                  alertJsNameCategory.innerText = 'This field is required.';
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
                              this.parentElement.parentElement.submit();
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
if (document.getElementById('selectCategories') || document.getElementById('selectTrademarks')) {

  var selectTrademarks = document.getElementById('selectTrademarks');
  var alertJsSelectTrademark = document.getElementById('alertJsSelectTrademark');

  selectTrademarks.addEventListener("change", function(){
    if (this.options[this.selectedIndex].value == '') {
      alertJsSelectTrademark.innerText = 'This field is required';
    } else {
      alertJsSelectTrademark.innerText = '';
    }
  });

/* Form Select Category */
  var selectCategories = document.getElementById('selectCategories');
    var flag = true;
  selectCategories.addEventListener("change", function(){
    if (this.options[this.selectedIndex].value == '') {
      flag = true;
      alertJsSelectCategory.innerText = 'This field is required';
    } else {
      flag = false;
      alertJsSelectCategory.innerText = '';
    }
  });

/* Validation submit */
var btnRegisterCategoryTrademark = document.querySelector('[name="registerCategoryTrademark"]');

        btnRegisterCategoryTrademark.addEventListener('click', function(event){
          event.preventDefault();
          if (flag) {
            console.log(selectCategories.selectedIndex);
            event.preventDefault();
            var alertEmptySubmit = document.getElementById('alertEmptySubmit');
            alertEmptySubmit.innerText = 'You must select trademark and category.';
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
                this.parentElement.parentElement.submit();
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
  var btnCreateProduct = document.getElementById('btnCreateProduct');
  var flag = false;
  /*** vista registro ***/
  var arrayFormProd = Array.from(formProd.elements); //quitamos ulitmo elemento, el boton.
  arrayFormProd.pop();
  arrayFormProd.forEach(item => {
    item.addEventListener(
      'blur', function(){
        if (this.value == '') {
          flag = false;
          item.parentElement.childNodes[5].innerText='Please, complete this field.';
        } else {
          flag = true;
          item.parentElement.childNodes[5].innerText='';
        }
      }
    );
  });
  btnCreateProduct.addEventListener('click', function(event){
    event.preventDefault();
    if (flag) {
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
            this.parentElement.parentElement.submit();
          }
        });
      } else {
        event.preventDefault();
        var alertJsBtnCrudProd = document.querySelector('#alertJsBtnCrudProd');
        alertJsBtnCrudProd.innerText = 'Please, complete all fields before send the form.'
      }
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
        this.nextElementSibling.innerText='Please, complete this field.';
      } else {
        this.nextElementSibling.innerText='';
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
        alertJsBtnUpdateProd.innerText = 'You must complete all fields!'
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

/* **** VALIDACIONES DE Login **** */
if (document.getElementById('formLogin')) {
  var formLogin = document.getElementById('formLogin');
  var flag = false;
  var arrayFormLogin = Array.from(formLogin.elements);
  arrayFormLogin.pop();
      arrayFormLogin.forEach(item => {
              item.addEventListener('blur', function(){
                // console.log(this.value);
                    if (this.value == '') {
                      flag=true;
                      this.nextElementSibling.innerText="Please, complete this field.";
                    } else {
                      flag=false;
                      this.nextElementSibling.innerText="";
                    }

              });
    });
     formLogin.onsubmit = function(event){
           if (flag) {
             event.preventDefault();
             var alertSubmitLogin = document.querySelector('#alertSubmitLogin');
             console.log(alertSubmitLogin);
             alertSubmitLogin.innerText = 'Please, complete all fields.'
           }
     }
}
/* **** VALIDACIONES DE Login **** */

/* **** VALIDACIONES DE Register **** */
//SI SE ENCUENTRA EL FORM DE REGISTRACION Y EL SELECT DE LAS PROVINCIAS (PARA QUE NO LANCE ERROR EN OTRAS PAGINAS)
if (document.getElementById('provincesAPI')) {
//Traigo provincias de Argentina via Fetch
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
  }
});

  var flag = false;
  var selectProv = document.getElementById('provincesAPI');
  var myForm = document.getElementById('formRegister');
  var elementsMyForm = Array.from(myForm.elements);
  var errorProv = document.querySelector('.provHelp');
  elementsMyForm.pop(); //quitamos boton
  for (var element of elementsMyForm) {
    element.addEventListener('blur', function(){
      var alert = document.getElementById('error_' + this.getAttribute('name'));
      if (alert) {
        if (this.value.trim() == "") {
          flag = true;
          alert.innerText = 'This field is required.';
          alert.style.color="red";
        }
        if(this.value.trim() != "") {
          flag = false;
          alert.innerText = '';
        }
      }
    });
  }

  //cambiamos el nombre del archivo que se selecciona
  // if (document.getElementById('iptFileUpload')) {
  //   var inputFile = document.getElementById('iptFileUpload');
  //   inputFile.addEventListener('change', function(){
  //     if (document.getElementById('iptFileUpload').files[0]) {
  //       var contInputFile = document.getElementById('iptFileUpload').files[0].name;
  //       console.log('hola');
  //       var txtInputFile = document.getElementById('lblFileUpload');
  //       console.log(txtInputFile.firstChild.data);
  //       txtInputFile.firstChild.data = contInputFile;
  //     }
  //   });
  // }

  //validacion de select provinces
  // myForm.addEventListener('submit', function(event){
  //   if (selectProv.options[selectProv.selectedIndex].value === '') {
  //     event.preventDefault();
  //     var errorProv = document.querySelector('.provHelp');
  //     if(errorProv){
  //       errorProv.innerText = 'You must select a province.';
  //     }
  //   }
  // });

   //validamos submit de registracion (con add event no lo manda aunque no activemos los campos)
  myForm.addEventListener('submit', function(event){
        if (flag) {
          event.preventDefault();
          console.log(flag);
          var alertSubmitRegister = document.querySelector('#alertSubmitRegister');
          alertSubmitRegister.innerText = "Please, complete all fields."
        }
  });

  //validamos submit de registracion (con este lo manda igual a menos que activemos los campos)
  // myForm.onsubmit = function(event){
  //     if (flag) {
  //       event.preventDefault();
  //       console.log(flag);
  //       var alertSubmitRegister = document.querySelector('#alertSubmitRegister');
  //       alertSubmitRegister.innerText = "Please, complete all fields."
  //     }
  // }
}
/* **** VALIDACIONES DE Register **** */

});
