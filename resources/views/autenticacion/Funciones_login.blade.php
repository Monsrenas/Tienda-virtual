<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.0/firebase-auth.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.15.1/firebase-analytics.js"></script>

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

/*

// AUNTENTIFICAMOS SI EL USUARIO ESTA LOGUEADO
  firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    var displayName = user.displayName;
    var email = user.email;
    var emailVerified = user.emailVerified;
    if(emailVerified === false){
      var verificacion = "no verificado";
    }else{
      var verificacion = "verificado";
    }
    var photoURL = user.photoURL;
    var isAnonymous = user.isAnonymous;
    var uid = user.uid;
    var providerData = user.providerData;
    // document.getElementById('login').innerHTML="LOGEADO "+ email;
    document.getElementById( 'login' ).innerHTML =
    `<h1> Logueado ` + email +`</h1> <h2>`+verificacion+`</h2>
    <button onclick = "cerrar()"> Cerra sesion </button>
    <br><br>
    
    ` ;
    // console.log(user);
  } else {
    document.getElementById('login').innerHTML="";
  }
});   */
autenticado();

function xAutenticarse()
    {   
        acceso();
        if (error=''){
                        
                     }

    } 

function autenticado()
{
    firebase.auth().onAuthStateChanged(function(user) {  
                                                        if (user){
                                                                  $('.fa-user-circle').css("display", "none");
                                                                  $('#operaUser').css("display", "block");
                                                                  $('#dataUser').text(user.email);
                                                                  }
                                                      });
}

// ACCEDEMOS
function acceso(){
    var email = document.getElementById('MIcorreo').value;
    var pass = document.getElementById('palabraSecreta').value;

    firebase.auth().signInWithEmailAndPassword(email, pass).catch(function(error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
        
      if (errorCode) { $('#MnsgError').append('Nombre de usuario o contraseña no validos') } 
      // ...
    }).then(function(user){ 
                              if (user.user.emailVerified) {
                                        $('.fa-user-circle').css("display", "none");
                                        $('#operaUser').css("display", "block");
                                        $("[data-dismiss=modal]").trigger({ type: "click" });
                                      }
                                 else { 
                                        $('#MnsgError').append('Correo no Verificado. Complete el proceso');
                                        cerrar(); 
                                      }
                          });
  }

  function crear(){
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

// CERRAMOS LA session
function cerrar(){
  firebase.auth().signOut()
    .then(function(){
      $('.fa-user-circle').css("display", "block");
      $('#operaUser').css("display", "none");
    })
    .catch(function(error){
      console.log(error);
    })
}
</script>