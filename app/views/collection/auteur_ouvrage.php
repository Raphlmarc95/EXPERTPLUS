
<!-- -->
<div class="row" style="justify-content:center;text-align: center; ">
<h4 > Ouvrage publie par  <?php echo $req[0]->pseudo; ?></h4>
<div class="columns small-12">
  <span class="collection_header">R&eacutecit</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php  foreach($req as $rows): ?> 
      <?php if(($rows->categorie) === 'recit'): ?>
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

  <div class="columns large-5" style="text-align:center; margin-top:2em" >
    <?php //if( $this->session->userdata('pseudo') !== NULL ){ ?>
    <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
       <button class="fill_button" >
          Commencer la lecture 
          <i class="fas fa-book 2x" ></i>
       </button>
    </a>
    <?php //} else {
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
  <?php endif ?>
    <?php  endforeach ?>
  </div>
</div>

</div>


<!-- -->
<div class="row" style="justify-content:center;text-align: center; ">
<div class="columns small-12">
  <span class="collection_header">Th&eacuteatres</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php  foreach($req as $rows): ?> 
      <?php if(($rows->categorie) === 'theatre'): ?>
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

  <div class="columns large-5" style="text-align:center; margin-top:2em" >
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
  <?php endif ?>
    <?php  endforeach ?>
  </div>
</div>

</div>


<!-- -->
<div class="row" style="justify-content:center;text-align: center; ">
<div class="columns small-12">
  <span class="collection_header">Po&eacutesies</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php  foreach($req as $rows): ?> 
      <?php if(($rows->categorie) === 'poetique'): ?>
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

  <div class="columns large-5" style="text-align:center; margin-top:2em" >
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
  <?php endif ?>
    <?php  endforeach ?>
  </div>
</div>

</div>


<!-- -->
<div class="row" style="justify-content:center;text-align: center; ">
<div class="columns small-12">
  <span class="collection_header">Litterature d'id&eacutees</span>
</div>
<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">

    <?php  foreach($req as $rows): ?> 
      <?php if(($rows->categorie) === 'litterature'): ?>
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

  <div class="columns large-5" style="text-align:center; margin-top:2em" >
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
  <?php endif ?>
    <?php  endforeach ?>
  </div>
</div>

</div>