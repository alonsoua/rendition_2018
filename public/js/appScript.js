// function formatoMiles(input) {
// 	var num = input.value.replace(/\./g,'');
// 	if(!isNaN(num)){
// 	num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
// 	num = num.split('').reverse().join('').replace(/^[\.]/,'');
// 	input.value = num;
// 	}
	 
// 	else{ alert('Solo se permiten numeros');
// 	input.value = input.value.replace(/[^\d\.]*/g,'');
// 	}
// }

// var number = document.querySelectorAll('.miles');

// number.forEach(function(elem) {
//   elem.addEventListener('input', (e) => {
//       var element = e.target;
//       var value = element.value;
//       element.value = formatNumber(value);
//     });
// });

// function formatNumber (n) {
// 	n = String(n).replace(/\D/g, "");
//   return n === '' ? n : Number(n).toLocaleString();
// }


// Si se preciona una tecla en el documento
document.addEventListener('keyup', (e) => {
  const element = e.target;

  // Si el elemento tiene la clase `miles`
  if (element.classList.contains('miles')) {
    element.value = formatoMiles(element.value);
  }

  // Si el elemento tiene la clase `decimales`
  else if (element.classList.contains('decimales')) {
    element.value = formatoDecimales(element.value);
  }
});

function formatoMiles(n) {
  n = String(n).replace(/\D/g, "");
  return n === '' ? n : Number(n).toLocaleString();
}

function formatoDecimales(n) {
  	var RE = /^\d*(\.\d{1})?\d{0,1}$/;
	if (RE.test(valor)) {
	    return true;
	} else {
	    return RE;
	}
  //return n === '' ? n : Number(n).toLocaleString();
}

function msgEliminarRegistroUtilizado (gramatica, texto) {
  if (gramatica == 'F') {
    return 'La '+ texto +' que intenta eliminar, está siendo utilizada en el sistema.';
  } else if (gramatica == 'M') {
    return 'El '+ texto +' que intenta eliminar, está siendo utilizado en el sistema.';
  }
}

function msgEliminadoCorrectamente (gramatica, texto) {
  if (gramatica == 'F') {
    return 'La '+ texto +' fue eliminada correctamente';
  } else if (gramatica == 'M') {
    return 'El '+ texto +' fue eliminado correctamente.';
  }
}