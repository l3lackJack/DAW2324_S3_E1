function changeImage(element) {
      var imatge_producte = document.getElementById('imatge_producte');
      imatge_producte.src = element.src;      
}
 
function sumarUnProducte() {
      let valor = document.getElementById("cantitat_productes")
      valor.value = parseInt(valor.value) + 1
}  

function restarUnProducte() {
      let valor = document.getElementById("cantitat_productes")
      valor.value = parseInt(valor.value)
      if (valor.value > 0) {
            valor.value = valor.value - 1    
      }
} 

function changeImage(element) {
      var imatge_producte = document.getElementById('imatge_producte');
      imatge_producte.src = element.src;      
}
 
function sumarUnProducte() {
      let valor = document.getElementById("cantitat_productes")
      valor.value = parseInt(valor.value) + 1
}  

function restarUnProducte() {
      let valor = document.getElementById("cantitat_productes")
      valor.value = parseInt(valor.value)
      if (valor.value > 0) {
            valor.value = valor.value - 1    
      }
} 
