 <table class="table table-striped">
 @foreach ($banner as $key=>$imagen)
 	<tr>  
	 	<td class="marco_banner" style="padding: 0px; margin: 0px;" >	
		 	  
		 		<img class="marco_banner" src="{{$imagen}}">
		 
	 	</td>
	 	<td width="20">
	 		<button style="margin: 0 auto;" type="button" onclick="javascript: EliminaBanner('{{$imagen}}')	">Eliminar</button>
	 	</td>
 	</tr>		
  @endforeach
 </table>