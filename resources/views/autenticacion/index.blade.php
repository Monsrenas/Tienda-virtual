<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>REGISTRO DE USUARIO</h1>
<a href="login.html">Login</a>
<br><br>
<input type="email" name="email" id="email" placeholder="EMAIL">
<input type="password" name="pass" id="pass" placeholder="Contraseña">
<button onclick="enviar()">Enviar</button>

<h2>LOGIN CON FACEBOOK</h2>
<button onclick="facebook()">Facebook</button>


<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.15.4/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.15.4/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDeSFFdC3CIXZ-ZdG-VKtZV9cJ2H-1Qj7s",
    authDomain: "maz-partes.firebaseapp.com",
    databaseURL: "https://maz-partes.firebaseio.com",
    projectId: "maz-partes",
    storageBucket: "maz-partes.appspot.com",
    messagingSenderId: "6510989654",
    appId: "1:6510989654:web:63bb3b6fb3edce9c6786f7",
    measurementId: "G-Y9YRXME97B"
  };
  // Initialize Firebase
   var variable = firebase.initializeApp(firebaseConfig);
  firebase.analytics();



  function enviar(){
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;

    firebase.auth().createUserWithEmailAndPassword(email, pass)
    .catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        alert(errorMessage);
    }).then(function(){
      // VERIFICAMOS EL CORREO
      verificar();
    });
  }
// VERIFICAMOS EL CORREO
  function verificar(){
    var user = firebase.auth().currentUser;

    user.sendEmailVerification().then(function() {
      // Email sent.
    }).catch(function(error) {
      // An error happened.
    });
  }

// ACCOUT CON FACEBOOK
function facebook(){
  var provider = new firebase.auth.FacebookAuthProvider();

    firebase.auth().signInWithPopup(provider).then(function(result) {
      
      var token = result.credential.accessToken;
      var user = result.user;

      console.log(user);
      
    }).catch(function(error) {
      
      var errorCode = error.code;
      var errorMessage = error.message;
      var email = error.email;
      var credential = error.credential;
      console.log(error);
    });
}
</script>
</body>
</html>