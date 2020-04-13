window.addEventListener('load', function() {
  fetch('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre')
  .then(function(data) {
    return data.json();
  }).then(function(dataProvincias) {
    let arrayProvincias = dataProvincias.provincias;
    if (document.getElementById('provincesAPI')) {
      let selectProvincias = document.getElementById('provincesAPI');
      // console.log(dataProvincias.provincias);
      var option = document.createElement('option');
      arrayProvincias.sort();
      for (var provincia of arrayProvincias) {
        // console.log(provincia.nombre);
        selectProvincias.innerHTML += `<option value="${provincia.nombre}"> ${provincia.nombre} </option>`
      }
    }
  });

  if (document.getElementById('formRegister') && document.getElementById('provincesAPI')) {
    var selectProv = document.getElementById('provincesAPI');
    var myForm = document.getElementById('formRegister');

    myForm.addEventListener('submit', function(event){
      if (selectProv.options[selectProv.selectedIndex].value === 'empty') {
        event.preventDefault();
        var errorProv = document.querySelector('.provHelp');
        if(errorProv){
          errorProv.innerText = 'This field is required.';
        }
      }
    });

    var myForm = document.getElementById('formRegister');
    var elementsMyForm = Array.from(myForm.elements);
    elementsMyForm.pop();
    for (var element of elementsMyForm) {
      element.addEventListener('blur', function(){
        var alert = document.getElementById('error_' + this.getAttribute('name'));
        if (this.value.trim() == "") {
          alert.innerText = 'This field is required.';
          alert.style.color="red";
        }
        if(this.value.trim() !== "") {
          alert.innerText = '';
        }
      });
    }
  }

  var inputFile = document.getElementById('iptFileUpload').files[0].name;
  var txtInputFile = document.getElementById('lblFileUpload');
  console.log(txtInputFile.firstChild.data);
  txtInputFile.firstChild.data = inputFile;

})
