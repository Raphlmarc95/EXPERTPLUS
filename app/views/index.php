
 <div class="grid-x" > <!-- begin of banner photo -->
  <div class="cell large-12 medium-12" style="min-height:100px;" id="banner">
<div class="row" style="text-align:center;">
      <h2 align="center">Bienvenue sur la plateforme Biblioplus</h2>
    <h5 style="color:white">Le point d'intersection entre auteurs et les amants du livres </h5> 
</div>  
    </div> 
    </div>

    <div class="grid-container">
        <div class="grid-x ">
          <div class="cell small-12 large-12" style=" margin-top:2em;  text-align:center;" >
      <h3>D&eacutecouvrez notre catalogue  </h3>
      <p>Des livres de tous genres: Romans, Historique, Scientifiques</br>
      Rien que pour le plaisir de vos yeux </p>
                      
      </div>   
    </div>
    </div> <!-- end of gridC -->
    <!--Catalogue Ouvrage-->
   <div class="row">

<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="padding-top:15px;">

    <?php $livres = $this->Collection_model->index_livres(); ?>
    <?php  foreach($livres as $rows): ?>
      <? var_dump($livres)?>
      <div class="items" >
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/web/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        <div id="info_ouvrage" style="width: 180px;">
                      <strong><?php echo $rows->titre;?> </strong><br />
                              <?php echo $rows->pseudo;?>

                       </div>
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em; justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12 large" style="text-align:center;">
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

<div class="row" style="border:0.4px solid  white ">
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

</div> 
     
    <div class="row">
      <div class="columns large-12" style="text-align:center;">
       <a href="http://localhost/biblioplus/collection/index"> 
          <button class="border_button" href="#" >
          Vers tous les ouvrages <i class="fas fa-arrow-right"></i>
          </button>
        </a>
      </div>
    </div>
             
         <!-- TOP 3 AUTEURS -->
<div class="auteur_setion">
  <div class="row" style="justify-content:center;" >
    <div class="columns small-12 medium-12 large-12"> <h4>Les auteurs de la semaine</h4> </div>
    <?php if ($auteurs) {?>
      <?php foreach ($auteurs as $rows ): ?>
        <?php if($rows->status === 'Auteur'): ?>
        <div  class="columns large-4 medium-6 small-10">
          <div class="columns medium-12 " style="text-align:center;">
            <?php if(empty($rows->photo)): ?>
              <a href="<?php echo base_url('auteur/info?id=').$rows->idmembre?>">
              <img src="<?php echo base_url('assets/avatar/avatar.png') ?>" class="circle_round" />
            </a>
            <?php else :?>
              <a href="<?php echo base_url('auteur/info?id=').$rows->idmembre?>">
              <img src="<?php echo base_url('assets/avatar/'.$rows->photo) ?>" class="circle_round" />
            </a>
            <?php endif ?>
            </div>
            
            <div class="columns medium-12">
            <h5> <?= $rows->pseudo ?></h5>
             <span class="span_titre"> <?= $rows->email; ?></span>
            </div>
        </div>
      <?php endif ?>
      <?php endforeach ?>
    <?php } ?>
  </div>
</div>

  <div class="row">
    <div class="columns large-12 medium-12" style=" margin-top:2em; text-align:center;">
      <h3>Les &eacutev&eacutenements les plus proches</h3>
      <p>Amant du livre, vous qui ne voulez pas manquer un &eacutev&eacutenement auxquel vous voulez prendre part<br/> dans cette section vous resterez informer.</p>                      
    </div> 
  </div>
    <div class="row" style=" justify-content:center;" >
          <?php $req = $this->evenement_model->lister_event_index(); ?>
          <?php if($req): ?>
            <?php foreach ($req as $key ): ?>
            
      <div class=" columns large-3  medium-4 small-9 evenement"  data-open="<?php echo $key->idevenement.'event'; ?>" 
      style="padding:0px; margin:15px;background-color:#dcece2;">
                            
         <?php if(empty($key->photo )){ ?>
              <img src="http://via.placeholder.com/350x200" class="thumbnail"   />
            <?php } else {?>
             <img src="<?php echo base_url('assets/img/'.$key->photo); ?>" style="width: 100%; height:170px;" />
           <?php } ?>
         <!-- end of photo -->
    
             <div class="columns large-12 medium-12 small-12"> <!-- info -->
               <div class="columns large-12 medium-12 small-12">
                <span class="span_titre" ><?php echo $key->titre; ?></span>
               </div>
             </div>
           <div class="columns large-8 medium-8 small-8" >      
           <strong><?php echo $key->event_mois; ?></strong><br>
            <span class="span_description"><?php echo $key->lieuEvenement; ?></span>
          </div>
           
             <div class="columns large-3 medium-4 small-4 ">
              
                <?php if(empty($key->m_foto)){ ?>
                  <img style="border-radius: 50%; width: 30px; height: 30px; " src="<?php echo base_url('assets/avatar/avatar.png'); ?>" title="<?php echo $key->pseudo; ?>"  alt="photo utilisateur" />
                <?php } else { ?>
                 <img  style="border: 0px; width:35px; height:35px;" src="<?php echo base_url('assets/avatar/'.$key->m_foto); ?>" class="circle_round_evenement" />
               <?php } ?>
            
           </div> 

         </div> 
     

       <!-- Modal Voir un evenement -->

          <div class="reveal " id="<?php echo $key->idevenement.'event'; ?>" data-reveal style="display:none; background-color:white;">
            <div class="rows " style="justify-content:center;text-align:center; "> 
              <div class="columns large-8 medium-10 large-centered" 
              margin-right:auto;" >
            
                  
            
            
               <?php if(empty($key->photo )){ ?>
                  <img src="http://via.placeholder.com/350x200" class="thumbnail" style="width: 200px; height:250px; "  />
                <?php } else {?>
                 <img src="<?php echo base_url('assets/img/'.$key->photo); ?>" class="thumbnail" style="width:100%; height:210px; " />
               <?php } ?>
           
                
                
          <?php if ($this->session->userdata('idmembre') === $key->idmembre) : ?>
            <div class=" columns large-12 medium-12" style="border-bottom: 1px solid #f3f1f1; margin-bottom:5px; margin-top: 10px;">
                 <a href="#" data-open="<?php echo $key->idevenement.'evente';  ?>" ><i class="fa fa-edit"></i>modifier </a>

                 <a  href="#" data-open="modal_modifier_compte">
                  <i class="fa fa-trash">  </i>
                    Supprimer 
                  </a> 

                    

      <div class="reveal" id="modal_supp_evenements"  data-reveal>
<h6>Confirmation de suppression  </h6>
<hr>
  
<span class="span_description" style="text-align:center;">Voulez vous vraiment supprimer cet evenement?
</span>
  
<div class="columns small-12 medium-7 large-12" style="text-align:center;">  
     
      <button class="fill_button" aria-label="Dismiss alert" type="button" data-close>
          NON
        </button>      
 <a  href="http://localhost/biblioplus/event/enlever?idevenement=<?php echo $key->idevenement; ?>" title="supprimer votre événement"><i class="fa fa-trash"> </i>
        <button class="fill_button">OUI</button>  </a>
      </div>
      </div>


              </div>
            <?php endif ?>
                 <!-- fin modal suppression evenement --> 
                 <div class="columns large-12 medium-7" style="margin-top:5px;  word-wrap: break-word; text-align: justify; border-bottom: 1px solid #f3f1f1 ">
                 <span class="span_titre" ><?php echo $key->titre; ?></span>
                
                </div>
                <div class="columns large-12 medium-7" style="margin-top:5px;  word-wrap: break-word; text-align: justify; border-bottom: 1px solid #f3f1f1 ">
                 <span class="span_titre">Description</span> 
                  <span class="span_description"> <?php echo $key->description; ?></span>
                </div>
                <div class="columns large-12 medium-5" style="margin-top:5px;">
                    <div class="columns large-12 medium-12 small-12">
                   
                   
                  
                    
                    <div class=" columns large-12 medium-12 small-12">
                       <span class="span_titre"><?php echo $key->event_deb; ?> <br/> <?php echo $key->event_fin; ?></span>
                    </div>
                    </div>
                    <div class="columns large-12 medium-12 small-12"  style="margin-top: 10px;">
                    <div class=" columns large-12 medium-12 small-12">
                       <span class="span_description"><?php echo $key->lieuEvenement; ?></span>
                    </div>
                    <div class=" columns large-12 medium-12 small-12" style="margin-top: 5px;">
                  
                    
                    </div>
                    </div>
                </div>
           
                  
                 
                    
                  
                  <div class="columns small-12 medium-12" style="margin-top:1em; text-align:center; margin-bottom:5px;">
                  <h5 align="center" >Partager avec des amis</h5>
                  <a><i class="fab fa-facebook-f fa-2x" style="background-color:silver; border-radius:50%;  color:white ; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-google fa-2x" style="background-color:silver; border-radius:50%;  color:white; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-twitter fa-2x" style="background-color:silver; border-radius:50%;  color:white ; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-instagram fa-2x" style="background-color:silver; border-radius:50%;  color:white; padding:5px; width:30px;height:30px"></i></a>
                  </div>
                  
                <button class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
              </div>
          </div>
          <!-- Modal Voir un evenement -->
          <?php endforeach ?>
          <?php endif ?>



          <?php $req = $this->evenement_model->lister_event_index(); ?>
          <?php if($req): ?>
            <?php foreach ($req as $key ): ?> 
<!-- Commencement modal modifie_evenement -->
          <div class="reveal" id="<?php echo $key->idevenement.'evente'; ?>" data-reveal> 

            <div class="row">
              
                <div class="columns large-12 medium-12">
                  <h5>Modification d'un &eacutev&eacutenement</h5>
                </div>

            <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message):?>
              <div class="alert alert-<?= $type; ?>">
               <?= $message; ?>            
             </div>
           <?php endforeach ?>
           <?php unset($_SESSION['flash']) ?>
          <?php endif ?>
                <?php echo form_open_multipart('event/modifier','class=""');?> 
                <div class="columns large-6 medium-6" align="center">
                  <div class="col-sm-3 text-center">
                   <!--  <img class="avatar" src="<?php // echo base_url('assets/img/index.jpeg') ?>">
                    <br><br> -->
                    <div class="form-group">
                      <label for="avatar">Ajouter une image descriptif .. </label>
                      <input type="file" id="avatar" name="userfile" style="word-wrap: break-word">
                    </div>
                  </div>
                <div class="columns large-12 medium-12">
                  <label>Description
                    <textarea cols="10" name="descEvent" value="<?php echo $key->description; ?>" rows="5"></textarea>
                  </label>
                </div>   <?php // echo var_dump($key->idevenement); ?>
                </div>
                <input type="hidden" name="idEvent" value="<?php echo $key->idevenement; ?>">
                <div class="columns large-6 medium-6">
                  <div class="columns large-12 medium-12">
                  <input type="text" name="titreEvent" value="<?php echo $key->titre; ?>" placeholder="Entrez le nom " class="custom_input">
                  <input type="text" name="lieuEvent" value="<?php echo $key->lieuEvenement; ?>"  placeholder="Lieux/Adresse de " class="custom_input">
                  <label>Date debut
                  <input type="datetime-local" name="datedebutEvent" value="<?php echo $key->date_debut; ?>" class="custom_input">
                  </label>
                  <label>Date fin
                  <input type="datetime-local" name="datefinEvent" value="<?php echo $key->date_fin; ?>" class="custom_input">
                  </label>
                  <label for="Activites">Activites</label>
                  <div class="columns large-12 medium-12 small-12"> 
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="payant" id="prix" align="left"> Payant </input>
                  </div>
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="gratuit" id="gratuit" align="right"> Gratuit</input>
                  </div>
                   </div>
                  <div class=" columns large-4 medium-4 small-4" >
                    <label>Prix</label>
                    <input type="number" value="<?php echo $key->prix; ?>" name="prix" placeholder="GDES HT">
                  </div>
                  <div class=" columns large-8 medium-8 small-8">
                    <label>Point de vente</label>
                    <input type="text" value="<?php echo $key->point_de_vente; ?>" name="pointDevente" placeholder="Entrez un Point de vente">
                  </div>
                  <input class="fill_button" type="submit" id="addEvent" name="addEvent" value="Modifier"/> 
                </div>
                </div>

              <?php echo form_close();  ?>
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
          </div>

          <!-- Fin modal modifier_evenement -->
<?php endforeach ?>
<?php endif ?>
</div>
<div class="row">
      <div class="columns large-12" style="text-align:center;">
       <a href="http://localhost/biblioplus/event/index"> 
          <button class="border_button" href="#" >
          Voir tous les evenements <i class="fas fa-arrow-right"></i>
          </button>
        </a>
      </div>
    </div>

</div>


<hr>
<div class="row" style="justify-content:center;  margin-top:2em;  text-align:center;">

  
  <?php if ($notifications) : ?>
  <?php foreach ($notifications as $key ) :?>
<div class="columns large-2 info_sit">
  <h6> Membres</h6>
    <?php echo " ".$key->membres[0]->nbr_membre; ?> 
</div>
<div class="columns large-2">
<h6> Evenements</h6>
   <?php echo " ".$key->event[0]->nbr_event; ?> 
</div>
<div class="columns large-2">
    <h6> Sujets</h6>
   <?php echo " ".$key->post[0]->nbr_sujet; ?> 
</div>

<div class="columns large-2">
    <h6>Ouvrages</h6>
    <?php echo " ".$key->ouvrage[0]->nbr_ouvrage; ?> 
</div>
  <?php endforeach ?>
<?php endif ?>
<div class="columns large-2">
<?php //if(site_url('account/')){ ?>
    <?php // echo 'Le moi'; ?>
    <h6>Visiteurs</h6>
    <?php $v = $this->login_model->count_nbr_visiteur(); echo  $v[0]->nbr_visiteurs; 
   ?><?php //}   ?>
    </div>

</div>
</div>


    
  
   
<!-- Begining of footer -->