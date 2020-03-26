// console.log('hola desde archivo externo en Laravel');
//
// var cadena = "hola!";
// var array = ['1', 2, "claro"];
// var buleano = true;
//
// console.log(cadena);
// console.log(array);
// console.log(buleano);
//
// var arrayImpares=[];
// for (var i = 1; i <= 137; i++) {
//   if (i%2!=0) {
//     arrayImpares.push(i);
//   }
// }
// console.log(arrayImpares);
function numeroAleatorio(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}
var ironMan = {
  nombre: "Iron Man",
  equipo: "Avengers",
  poderes: ['volar', 'lanzar misiles', 'disparar lásers'],
  energia: 100,
  getPoder: function(nro){
    if(nro == 0){
      console.log('Iron man va a VOLAR!');
      if (this.energía < 10) {
        return "Energía insuficiente!"
      }
      this.energia -= 10;
    } else if (nro == 1) {
      console.log('Iron man Lanzará sus misiles!');
      if (this.energía < 15) {
        return "Energía insuficiente!"
      }
      this.energia -= 15;
    } else {
      console.log('Iron man Disparara lásers!');
      if (this.energía < 25) {
        return "Energía insuficiente!"
      }
      this.energia -= 25;
    }
    console.log('Queda '+this.energia+'% de energía.');
    return this.poderes[nro];
  }
};

  var hulk ={
    nombre: "Hulk",
    equipo: "Avengers",
    poderes: ['aplastar', 'gritar', 'golpear'],
    energia: 100,
    getPoder: function(nro){
      var contador = 3;
      do {
        contador--;
        var poder = prompt('Qué hara Hulk?');

        switch (poder) {
          case 0:
          console.log('Hulk quiere aplastar!');
          if (this.energía < 10) {
            return "Energía insuficiente!"
          }
          console.log('SMAH!');
          this.energia -= 10;
          console.log('Queda '+this.energia+'% de energía.');

          break;
          case 1:
          console.log('Hulk quiere gritar!');
          if (this.energía < 15) {
            return "Energía insuficiente!"
          }
          console.log('GROAAAAAARRRR!');
          this.energia -= 15;
          console.log('Queda '+this.energia+'% de energía.');

          break;
          case 2:
          console.log('Hulk quiere golpear!');
          if (this.energía < 25) {
            return "Energía insuficiente!"
          }
          console.log('PUUUUUMMMMM!!!');
          this.energia -= 25;
          console.log('Queda '+this.energia+'% de energía.');

          break;
          default: 'La habiliadad ingresada no está disponible!!';
        }

      } while (contador > 0);

    }
};

// hulk.getPoder(numeroAleatorio(0,3));

var misDatos = {
  nombre: "Agustin",
  apellido: "Moya",
  dni: "36618841",
  comidaFav: 'Asado',
  edad: 27,
  saludar: function(){
    return 'Hola, mi nombre es ' + this.nombre + " " + this.apellido + " y tengo " + this.edad
 + " años."  }
};

// for (var prop in misDatos) {
//   if (misDatos.hasOwnProperty(prop)) {
//     console.log(prop + ": "+misDatos[prop]);
//   }
// }

// console.log(misDatos.saludar());
window.onload = function(){

var btn = document.getElementById('miBoton');
btn.onclick= function(){
  alert("Dont push me bro!");
};

}
