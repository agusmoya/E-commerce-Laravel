window.addEventListener('load', function() {
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
      element.addEventListener('change', function(){
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



})
