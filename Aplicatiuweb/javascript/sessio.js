$(document).ready(function () {
  //no es fa la funció fins que no carrega el document
  if (typeof sesionIniciada !== "undefined" && sesionIniciada) {
    // Comprovem si la variable 'sesionIniciada' està definida i és certa.
    console.log("Usuario ha iniciado sesión previamente."); // Mostrar per consola si l'usuari ha inciat sessió o no
    var html =
      '<li class="nav-item position-absolute end-0 me-5" id="registre-li">' + // Creem un fragment HTML amb un enllaç al perfil de l'usuari.
      '<a class="nav-link text-white" href="/Vistes/perfil.php">Perfil</a>' +
      "</li>";
    $("#registre-li").html(html); //Amb jquery afegirem el contingut a l'etiqueta
  } else {
    console.log("La sesión aún no ha sido iniciada");
  }
});
