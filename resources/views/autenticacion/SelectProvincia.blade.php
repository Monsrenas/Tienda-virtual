 Provincias('');

  function Cantones(canton){

    xProv=document.getElementById("provincia");
    

    if (xProv.selectedIndex==0) { return;}

    xCant=document.getElementById("canton");   

    for (let i = xCant.options.length; i >= 0; i--) {
          xCant.remove(i);
      }
            
    for (const prop in myJson[xProv.selectedIndex]['cantones']){
                
        var option = document.createElement("option"); 
        option.text = myJson[xProv.selectedIndex]['cantones'][prop]['canton'] ;
        option.value= prop;
        if (canton==prop) {
                            option.selected=true; 
                            
                          }        
        xCant.add(option);
      }
  }

  function Provincias(selecion){

      var x = document.getElementById("provincia");

      $("#provincia").empty();
      
      var option = document.createElement("option");    
      option.value= 0;
      x.add(option);

      for (var i = 1; i < (Object.keys(myJson).length); i++) {
        var option = document.createElement("option");    
        option.text = myJson[i]['provincia'] ;
        option.value= i;
        if (selecion==i) {
                            option.selected=true; 
                            
                          }
        x.add(option);
      }

      Cantones({{$lista[0]->canton ?? ''}});

  }
  