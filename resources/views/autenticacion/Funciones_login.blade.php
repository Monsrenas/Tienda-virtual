
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.21.1/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.21.1/firebase-auth.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.21.1/firebase-analytics.js"></script>

<?php if(!isset($_SESSION)){ session_start();} ?>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
   var firebaseConfig = {
    <?php echo($_SESSION['empresa']['firebase'] ?? ""); ?>

  };
  // Initialize Firebase
  var variable = firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  firebase.auth().languageCode = 'es';
  
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
      '<h1> Logueado ' + email +'</h1> <h2>'+verificacion+'</h2><button onclick = "cerrar()"> Cerra sesion </button><br><br>' ;
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
                                                                  abrirSeccionCliente(user.email);
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
                                         abrirSeccionCliente(email);
                                        $("[data-dismiss=modal]").trigger({ type: "click" });
                                         location.reload();
                                      }
                                 else { 
                                        $('#MnsgError').empty().append('Correo no Verificado. Complete el proceso a través del correo que le enviamos.');
                                        salir(); 
                                      }
                          });
  }

  function crear(email, pass){
    firebase.auth().createUserWithEmailAndPassword(email, pass)
    .then(function(){
      // VERIFICAMOS EL CORREO
      verificar();
      
    })
    .catch(function(error) {
        var errorCode = error.code;
        var errorMessage = error.message;
        if (errorCode=='auth/email-already-in-use') { alert('Esta dirección de correo electrónico ya está en uso'); return;} 
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
      $.get('seccionCliente/','', function(subpage){ 
          location.reload();   
      });
    })
    .catch(function(error){
      console.log(error);
    })
}

function salir(){
  firebase.auth().signOut()
    .then(function(){
          $('.fa-user-circle').css("display", "block") 
      $('#operaUser').css("display", "none");
      $.get('seccionCliente/','', function(subpage){ 
             
      });
    })
    .catch(function(error){
      console.log(error);
    })
}


function abrirSeccionCliente(email)
{
  $.get('seccionCliente/'+email,'', function(subpage){ 
        
    });
}
</script>