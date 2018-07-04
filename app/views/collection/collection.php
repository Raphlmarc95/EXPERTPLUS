<?php if (isset($_SESSION['flash'])): ?>
  <?php foreach ($_SESSION['flash'] as $type => $message):?>
     <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>            
     </div>
  <?php endforeach ?>
  <?php unset($_SESSION['flash']) ?>
<?php endif ?>

<div class="row" style="padding:2em; text-align:center;">
<div class="columns small-12 medium-12 medium-centered">
<h3>Un catalogue diversifi&eacute</h3>
<p>Diverse ouvrage en format multiple group&eacute par cat&eacutegorie</p>

</div>
<?php   
if(isset($_SESSION['pseudo'])===true) {
  if (isset($_SESSION['pseudo'])===true) {
      	echo '
      <p><button class="fill_button" data-open="modal_ajouter_ouvrage">Ajouter un ouvrage</button></p>';
  	} else {
    	echo'
    	<p><button class="fill_button" data-open="modal_connexion">Ajouter un ouvrage</button></p>';
    }
  }
  ?>
	
<div class="columns small-12">
	<span class="collection_header">R&eacutecit</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php $roman = $this->Collection_model->cat_ro(); ?>
    <?php  foreach($roman as $rows): ?>
      <div class="items" >
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em; justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12" style="text-align:center;">
<h5 style="margin:0px"><strong><?php echo $rows->titre; ?></strong></h5>
Publier par : <?php echo $rows->pseudo; ?> <br />
Email : <?php echo $rows->email; ?>
</div>

<div class="columns medium-6 small-12 large-3">
<img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" style="width:240px; height:290px;" alt="" class="thumbnail"/>

</div>

<div class="columns medium-9">

<div class="columns medium-12">
<strong>Description </strong> 
</div>
<div class="columns medium-12"><p>
<?php echo $rows->description; ?></p>

</div>

<div class="row" style="border:2px solid white">
<div class="columns medium-6">
<div class="columns medium-12">
<strong><u>Specifications</u></strong>
</div>
<div class="columns medium-12">
<strong>Langues :</strong><?php echo $rows->langue; ?>
</div>
<div class="columns medium-12">
<strong>Genre :</strong><?php echo $rows->categorie; ?>
</div>
<div class="columns medium-12">
<strong>Edition :</strong><?php echo $rows->edition; ?>
</div>
<div class="columns medium-12">
<strong>ISBN :</strong> <?php echo $rows->isbn; ?>
</div>

<div class="columns medium-12">
<strong>Pages :</strong><?php echo $rows->pages; ?>
</div>

<div class="columns medium-12">
<strong>Point de vente :</strong> <?php echo $rows->point_de_vente; ?>
</div>
</div>

  <div class="columns large-5 small-12" style="text-align:center; margin-top:2em" >
    <?php // if( $this->session->userdata('pseudo') !== NULL ){ ?>
    <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
       <button class="fill_button" >
          Commencer la lecture 
          <i class="fas fa-book 2x" ></i>
       </button>
    </a>
    <?php // } else {
        // echo 'Veuillez vous connecter pour lire';
   // } ?> 
  </div>
</div>

</div>
</div>
</div>
 
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true" >&times;</span>
</button>
</div>
<!--  fin modalInfoOuvrage Romans-->
    <?php  endforeach ?>
  </div>
</div>

<div class="columns small-12">
  <span class="collection_header">Th&eacuteatre</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php $theatre = $this->Collection_model->cat_thea(); ?>
    <?php  foreach($theatre as $rows): ?>
      <div class="items" >
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em;  justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12" style="text-align:center;">
<h5 style="margin:0px"><strong><?php echo $rows->titre; ?></strong></h5>
Publier par : <?php echo $rows->pseudo; ?> <br />
Email : <?php echo $rows->email; ?>
</div>

<div class="columns medium-6 small-12 large-3">
<img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" style="width:240px; height:290px;" alt="" class="thumbnail"/>

</div>

<div class="columns medium-9" >

<div class="columns medium-12">
<strong>Description </strong> 
</div>
<div class="columns medium-12"><p>
<?php echo $rows->description; ?></p>

</div>

<div class="row" style="border:0.5px solid white">
<div class="columns medium-6">
<div class="columns medium-12">
<strong><u>Specifications</u></strong>
</div>
<div class="columns medium-12">
<strong>Langues :</strong><?php echo $rows->langue; ?>
</div>
<div class="columns medium-12">
<strong>Genre :</strong><?php echo $rows->categorie; ?>
</div>
<div class="columns medium-12">
<strong>Edition :</strong><?php echo $rows->edition; ?>
</div>
<div class="columns medium-12">
<strong>ISBN :</strong> <?php echo $rows->isbn; ?>
</div>

<div class="columns medium-12">
<strong>Pages :</strong><?php echo $rows->pages; ?>
</div>

<div class="columns medium-12">
<strong>Point de vente :</strong> <?php echo $rows->point_de_vente; ?>
</div>
</div>
<div class="columns large-5  small-12" style="text-align:center; margin-top:2em" >
  <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
     <button class="fill_button" >
        Commencer la lecture 
        <i class="fas fa-book 2x" ></i>
     </button>
  </a>

</div>
</div>

</div>
</div>
</div>
 
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true" >&times;</span>
</button>
</div>
<!--  fin modalInfoOuvrage Romans-->
    <?php  endforeach ?>
  </div>
</div>

<div class="columns small-12">
  <span class="collection_header">Po&eacutesies</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php $poesis = $this->Collection_model->cat_poe(); ?>
    <?php  foreach($poesis as $rows): ?>
      <div class="items" >
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em;  justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12" style="text-align:center;">
<h5 style="margin:0px"><strong><?php echo $rows->titre; ?></strong></h5>
Publier par : <?php echo $rows->pseudo; ?> <br />
Email : <?php echo $rows->email; ?>
</div>

<div class="columns medium-6 small-12 large-3">
<img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" style="width:240px; height:290px;" alt="" class="thumbnail"/>

</div>

<div class="columns medium-9" >

<div class="columns medium-12">
<strong>Description </strong> 
</div>
<div class="columns medium-12"><p>
<?php echo $rows->description; ?></p>

</div>

<div class="row" style="border:2px solid white">
<div class="columns medium-6">
<div class="columns medium-12">
<strong><u>Specifications</u></strong>
</div>
<div class="columns medium-12">
<strong>Langues :</strong><?php echo $rows->langue; ?>
</div>
<div class="columns medium-12">
<strong>Genre :</strong><?php echo $rows->categorie; ?>
</div>
<div class="columns medium-12">
<strong>Edition :</strong><?php echo $rows->edition; ?>
</div>
<div class="columns medium-12">
<strong>ISBN :</strong> <?php echo $rows->isbn; ?>
</div>

<div class="columns medium-12">
<strong>Pages :</strong><?php echo $rows->pages; ?>
</div>

<div class="columns medium-12">
<strong>Point de vente :</strong> <?php echo $rows->point_de_vente; ?>
</div>
</div>
<div class="columns large-5 small-12" style="text-align:center; margin-top:2em" >
  <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
     <button class="fill_button" >
        Commencer la lecture 
        <i class="fas fa-book 2x" ></i>
     </button>
  </a>

</div>
</div>

</div>
</div>
</div>
 
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true">&times;</span>
</button>
</div>
<!--  fin modalInfoOuvrage Romans-->
    <?php  endforeach ?>
  </div>
</div>

<div class="columns small-12">
  <span class="collection_header">Litt&eacuterature d'id&eacutees</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php $literaire = $this->Collection_model->cat_lit(); ?>
    <?php  foreach($literaire as $rows): ?>
      <div class="items">
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em;  justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12" style="text-align:center;">
<h5 style="margin:0px"><strong><?php echo $rows->titre; ?></strong></h5>
Publier par : <?php echo $rows->pseudo; ?> <br />
Email : <?php echo $rows->email; ?>
</div>

<div class="columns medium-6 small-12 large-3">
<img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" style="width:240px; height:290px;" alt="" class="thumbnail"/>

</div>

<div class="columns medium-9" >


<div class="columns medium-12">
<strong>Description </strong> 
</div>
<div class="columns medium-12"><p>
<?php echo $rows->description; ?></p>
</div>

<div class="row" style="border:2px solid white">
<div class="columns medium-6">
<div class="columns medium-12">
<strong><u>Specifications</u></strong>
</div>
<div class="columns medium-12">
<strong>Langues :</strong><?php echo $rows->langue; ?>
</div>
<div class="columns medium-12">
<strong>Genre :</strong><?php echo $rows->categorie; ?>
</div>
<div class="columns medium-12">
<strong>Edition :</strong><?php echo $rows->edition; ?>
</div>
<div class="columns medium-12">
<strong>ISBN :</strong> <?php echo $rows->isbn; ?>
</div>

<div class="columns medium-12">
<strong>Pages :</strong><?php echo $rows->pages; ?>
</div>

<div class="columns medium-12">
<strong>Point de vente :</strong> <?php echo $rows->point_de_vente; ?>
</div>
</div>
<div class="columns large-5 small-12" style="text-align:center; margin-top:2em" >
  <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
     <button class="fill_button" >
        Commencer la lecture 
        <i class="fas fa-book 2x" ></i>
     </button>
  </a>
</div>
</div>

</div>
</div>
</div>
 
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true" >&times;</span>
</button>
</div>
<!--  fin modalInfoOuvrage Romans-->
    <?php  endforeach ?>
  </div>
</div>
<!-- modal for ajouter_ouvrage -->

<div class="reveal" id="modal_ajouter_ouvrage" data-reveal>
  
  <div class="row">
  <div class="columns medium-12">
    
<?php if (isset($_SESSION['flash'])): ?>
  <?php foreach ($_SESSION['flash'] as $type => $message):?>
     <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>            
     </div>
  <?php endforeach ?>
  <?php unset($_SESSION['flash']) ?>
<?php endif ?>

  <h5>Ajout d'un ouvrage</h5></div>
  <!-- <form id="ajout_ouvrage"> -->
    <?php echo form_open_multipart('collection/inserer_livre','');?> 
   <div class="columns medium-6 small-12">
  		  
		<input type="text" name="titre" class="custom_input" placeholder="Titre de l'ouvrage" id="titre" />
		<input type="text" name="isbn" class="custom_input" placeholder="ISBN" id="isbn" />
		 <input type="text" name="edition" class="custom_input" placeholder="Editions" id="edition" />
    
      <select id="langue" name="langue" class="custom_input">                     
        <option value="Francais">Francais</option>
        <option value="Anglais" >Anglais</option>
        <option value="Creole" >Cr&eacuteole</option>
      </select>

      <select id="categorie" name="categorie" class="custom_input">                     
        <option value="recit">R&eacutecit</option>
        <option value="theatre" >Th&eacuteatres</option>
        <option value="poetique" >Po&eacutesies</option>
        <option value="litterature" >Litterature d'id&eacutees</option>
      </select>
     <input type="number" name="pages" class="custom_input" placeholder="Pages" id="pages" maxlength="5" size="5" />  
  </div>
       
  <div class="columns medium-6 small-12">
    <input type="text" name="pointVente" class="custom_input" placeholder="Point de vente" id="pointVente" />
  </div>

<div class="columns medium-12">
  <label> Livre</label>
  <input type="file" name="couvertureOuvragePath" id="couvertureOuvragePath" />
</div> 

<div class="columns medium-12">
  <label>Couverture</label>
<input type="file" name="livreChemin" id="livreChemin" />
</div> 


<div class="columns medium-12">
  <textarea name="desc" id="desc" style="width:100%;" placeholder="Description de l'ouvrage"></textarea>
</div>
</div>
  	  <div class="columns medium-12" >
  	<!--   <hr/> -->
        <input type="submit" name="ajout_ouvrage" class="fill_button" value="Ajouter" id="save_ouvrage" />
</div>
</form>

<button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  </div>
  </div>
  </div>
  
</div>


</div></div>

