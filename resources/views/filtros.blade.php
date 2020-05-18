<!DOCTYPE html>
<br>
<style type="text/css">
  .panel {
    margin-bottom: 2px;
    
  } 

  .panel-body { max-height: 440%;
                height: 440%; 
                overflow: auto scroll; 
                background: white;  
             -webkit-box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);
-moz-box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);
box-shadow: inset 0px 0px 14px 0px rgba(32,73,144,1);} 
.collapsed {
  outline: none;

}

.barra {
    background: #768AC2;

}

.IntHead {font-size: medium;
          width: 100%;
          text-align: center;
          color: white;}
         
</style>

<div class="container-fluid">
<div id="faq" role="tablist" aria-multiselectable="true">

<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionThree" style="background:#3149D5; color: white;  ">
<h5 class="panel-title">
<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerThree" aria-expanded="false" aria-controls="answerThree">
    <div>
      <div class="IntHead">MARCAS / MODELOS</div>
    </div> 
</a>
</h5>
</div>
<div id="answerThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="questionThree">
<div class="panel-body" id="Interrogation">

            <ul id="myUL">
              <!--
              <li><span class="caret">Beverages</span>
                <ul class="nested">
                  <li>Water</li>
                  <li>Coffee</li>
                  <li><span class="caret">Tea</span>
                    <ul class="nested">
                      <li>Black Tea</li>
                      <li>White Tea</li>
                      <li><span class="caret">Green Tea</span>
                        <ul class="nested">
                          <li>Sencha</li>
                          <li>Gyokuro</li>
                          <li>Matcha</li>
                          <li>Pi Lo Chun</li>
                        </ul>
                      </li>
                    </ul>
                  </li>  
                </ul>
              </li>-->

              <div id='marcasLi' class="lista">
              
              </div>
            </ul>


</div>
</div>
</div>


<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionOne" style="background:#3149D5; color: white;">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="true" aria-controls="answerOne">
  <div>
    <div class="IntHead" >CATEGORIAS</div>
  </div>  
</a>
</h5>
</div>
<div id="answerOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionOne">
<div class="panel-body" id="categorias">
      @include('categorias');
</div>
</div>
</div>
<!--
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="questionTwo" style="background:#3149D5; color: white;">
<h5 class="panel-title">
<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo" aria-expanded="false" aria-controls="answerTwo" target='_blank'>
        <div>LABORATORY EXAMS</div> 
</a>
</h5>
</div>
<div id="answerTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionTwo">
<div class="panel-body" id="Laboratory"> 
  
</div>
</div>
</div> -->

</div>
</div>
    
<!-- Initialize Bootstrap functionality -->
<script>
// Initialize tooltip component
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function () {
  $('[data-toggle="popover"]').popover()
})

  $('.panel-body').css("height", screen.height-510);
  $('.panel-body').css("max-height", screen.height-510);                          

  /*PreLoadDataInView('#Interrogation', '&modelo=Interrogation&url=consultation.interrogation', 'flexlist');
   echo VIEW::make("consultation.PhysicalExamination")*/
</script>