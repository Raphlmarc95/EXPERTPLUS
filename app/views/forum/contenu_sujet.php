

<div class="row" id="contenair_contenu_sujet" >
	<div class="columns large-12 medium-12"  >
<div class="columns large-12 medium-12" id="entete">
		<h3 >Forum Biblioplus</h3>
</div>

<div class="columns large-12 medium-12">
		<h5 id="text"> Faites de vos exp&eacuteriences d'engrais pour augmenter <br/> l'app&eacutetit des autres a la lecture</h5>
	</div>



         <div class="columns large-12 medium-12" id="box_sujet_poster">
	    <div class=" columns large-12 medium-12" id="sujet">
		  <h3 id="sujet"> Le Sujet</h3>
	    </div>

	    <div class="columns large-12 medium-12" id="categorie">
	    	<h6>Le Categorie</h6>
	    </div>	 		

	    <div class="columns large-12 medium-12" style=" padding: 0px;">

	    	<div class="columns large-1 medium-1"style="padding: 0px; text-align: center; font-style: italic; color: gray;">
	    	<div class="columns large-12 medium-12" >
	    	<img src="https://placehold.it/50x50" class="thumbnail" alt="" style="border-radius: 50%">
	    	</div>
	    	<div class="columns large-12 medium-12">
	    	<small><span>nom posteur</span></small>	
	    	</div>
	    	</div>

	    	<div class="columns large-11 medium-11" id="contenu_sujet">
	    	<p style="text-align: justify;">
	    		Les navigateurs peuvent utiliser ces éléments pour activer le défilement du corps de la table indépendamment de l'en-tête et du pied de page. 
	    	</p>
	    	</div>

	    	<div class="columns large-12 medium-12">
	    		<input type="button" id="show" value="réagir">
	    	</div>
	    	

	    	<script type="text/javascript">
	    		$('#show').click(function() {
	    			// body...
	    			$('#espace_de_reaction').show();

	    			$('#valider').click( function () {
	    				// body...
	    				$('#espace_de_reaction').hide(); 
	    			} )
	    		})
	    	</script>

	    </div>

	</div>
	<div class="columns large-12 medium-12" id="espace_de_reaction">
	<form>

	<div class="columns large-12 medium-12" >
     <textarea name="textarea" placeholder="Tapez votre r&eacuteaction">  </textarea>
		   <script>
			CKEDITOR.replace( 'textarea' );
		</script>  
	</div>
    <div class="columns large-12 medium-12">
    	<input type="button" id="valider" name="" value="valider">
    </div>
	</form>
	</div>

	<div class="columns large-12 medium-12" id="reaction">
	    	<div class="columns large-1 medium-1"style="padding: 0px; text-align: center; font-style: italic; color: gray;">
	    	<div class="columns large-12 medium-12" >
	    	<img src="https://placehold.it/50x50" class="thumbnail" alt="" style="border-radius: 50%">
	    	</div>
	    	<div class="columns large-12 medium-12">
	    	<small><span>nom posteur</span></small>	
	    	</div>
	    	</div>
    <div class="columns large-11 medium-11 " style="text-align: justify; padding: 0px; position: relative; top: 10px;"> 
    	<div class="columns large-12 medium-12" style="text-align: right; font-style: italic; color: gray;">date de r&eacuteponse</div>
        <div class="columns large-12 medium-12">
    	<p>Les navigateurs peuvent utiliser ces éléments pour activer le défilement du corps de la table indépendamment de l'en-tête et du pied de page.</p>
    	</div>
    </div>    
	</div>
	</div>
</div>
<div>
</div>
</body>
</html>