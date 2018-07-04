<div class="row" id="ListeAuteur" style="margin-top:2em; ">
<div class="columns  small-12 medium-12 large-12" style="text-align:center;">

	<h3>Trouver les auteurs </h3>

</div>
<div class="columns medium-10 small-10" style=" margin:auto;">
<ul class="alphabetiqueMenu" >
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=A">A</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=B">B</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=C">C</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=D">D</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=E">E</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=F">F</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=G">G</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=H">H</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=I">I</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=J">J</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=K">K</a></li>

	<li><a href="http://localhost/biblioplus/auteur/index?lettre=L">L</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=M">M</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=N">N</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=O">O</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=P">P</a></li>

	<li><a href="http://localhost/biblioplus/auteur/index?lettre=Q">Q</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=R">R</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=S">S</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=T">T</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=U">U</a></li>

	<li><a href="http://localhost/biblioplus/auteur/index?lettre=V">V</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=W">W</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=X">X</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=Y">Y</a></li>
	<li><a href="http://localhost/biblioplus/auteur/index?lettre=Z">Z</a></li>


</ul>
</div>
</div>
<div class="row" style="justify-content:center;">
	<?php if ($auteurs) { ?>
		
		<?php foreach ($auteurs as $rows ): ?>		
			  <div class="column large-2 medium-4 small-5 auteurCadreInfo">
			    <div class="medium-12" style="padding:10px">
			    <a href="<?php echo base_url('auteur/info?id=').$rows->idmembre?>">	
			  	 <img src="<?php echo base_url('assets/avatar/'.$rows->photo) ?>" class="circle_round" />
			  	</a>
			    </div>
				<div class="medium-12" style="background-color:#2e7f4d; padding: 8px; "> 
					<h5 style="margin-bottom:0px">  <?php echo $rows->pseudo ?></h5>
				</div>
			  </div>	
		<?php endforeach ?>
		
	<?php } else {
		echo 'Aucun resultat trouver';
	} ?>
</div>

<?php

   $config = array();

   $config["base_url"] = base_url() . "auteur/index";

   $config["total_rows"] = $this->Auteur_model->record_count();

   $config["per_page"] = 1;

   $config["uri_segment"] = 3;

   $this->pagination->initialize($config);

   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

   $data["results"] = $this->Auteur_model->fetch_departments($config["per_page"], $page);

   $data["links"] = $this->pagination->create_links();

?>
