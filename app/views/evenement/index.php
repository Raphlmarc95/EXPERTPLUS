
  
  <div class="row" style="margin-top:3em" >             

      
     
        <h4>Le calendrier des &eacutev&eacutenements litteraires</h4>
      <?php if (isset($_SESSION['flash'])): ?>
              <?php foreach ($_SESSION['flash'] as $type => $message):?>
                <div class="callout <?= $type; ?>">
                 <?= $message; ?>            
               </div>
             <?php endforeach ?>
             <?php unset($_SESSION['flash']) ?>
          <?php endif ?>

      <div class="columns large-12 medium-6 small-12 " style="text-align:right;" >        
        <a  data-open="modal_ajout_evenement" >
          <?php if ($this->session->userdata('pseudo') !== NULL) : ?>
          <i class="fa fa-plus-square"></i> Ajouter un nouvel &eacutev&eacutenement
        <?php endif ?>
        </a>
      </div>
     

   

    <div class="row " style=" justify-content:center;" >
          <?php $req = $this->evenement_model->lister(); ?>
          <?php if($req): ?>
            <?php foreach ($req as $key ): ?>
            
      <div class=" columns large-3  medium-4 small-9 evenement"  data-open="<?php echo $key->idevenement.'event'; ?>"  style=" padding:0px; margin:10px;background-color:#dcece2;">
        
                    
         <?php if(empty($key->photo )){ ?>
              <img src="http://via.placeholder.com/350x200" class="thumbnail"   />
            <?php } else {?>
             <img src="<?php echo base_url('assets/img/'.$key->photo); ?>"  style="width: 100%; height:170px; " />
           <?php } ?>
         <!-- end of photo -->
    
             <div class="columns large-12 medium-12 small-12"  > <!-- info -->
               <div class="columns large-12 medium-12 small-12"><span class="span_titre" ><?php echo $key->titre; ?></span>
               </div>
             </div>
           <div class="columns large-8 medium-8 small-8" >      
           <strong><?php echo $key->event_mois; ?></strong><br>
            <span class="span_description"><?php echo $key->lieuEvenement; ?></span>
          </div>

           
             <div class="columns large-3 medium-4 small-4 ">
              
                <?php if(empty($key->m_foto)){ ?>
                  <img style="border-radius: 50%; width: 35px; height: 35px; " src="<?php echo base_url('assets/avatar/avatar.png'); ?>" title="<?php echo $key->pseudo; ?>"  alt="photo utilisateur" />
                <?php } else { ?>
                 <img  style="border: 0px; width:35px; height:35px;" src="<?php echo base_url('assets/avatar/'.$key->m_foto); ?>" class="circle_round_evenement" />
               <?php } ?>
            
           </div> 

         </div>

        
        
        
    <!--     
         <div class="columns large-12 medium-12" align="right">
         <span style="font-style: italic; font-size: 12px;">
          </span>
       </div> -->
      
     

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
               
                
                
            <?php if ($this->session->userdata('pseudo') !== NULL) : ?>
              <div class=" columns large-12 medium-12" style="border-bottom: 1px solid #f3f1f1; margin-bottom:5px; margin-top: 10px;">
                   <a href="#" data-open="<?php echo $key->idevenement.'evente';  ?>" ><i class="fa fa-edit"></i>Modifier </a> 
                   
                   <a data-open="modal_supp_evenements"><i class="fa fa-trash"></i>
                   Supprimer  </a> 

                    











              </div>
            <?php endif ?>
                 <!-- fin modal suppression evenement --> 
                <div class="columns large-12 medium-7" style="margin-top:5px;  word-wrap: break-word; text-align: justify; border-bottom: 1px solid #f3f1f1 ">
                 <span class="span_titre">Description</span> <br />
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

    </div>

   

          <!-- Commencement modal ajout_evenement -->
                       <div class="reveal" id="modal_supp_evenements"  data-reveal>
<h6>Confirmation de suppression  </h6>
<hr>
  
<span class="span_description" style="text-align:center;">Voulez vous vraiment supprimer cet evenement?
</span>
  
<div class="columns small-12 medium-7 large-12" style="text-align:center;">  
     
      <button class="fill_button" aria-label="Dismiss alert" type="button" data-close>
          NON
        </button>      
 <a  href="http://localhost/biblioplus/event/enlever?idevenement=<?php echo $key->idevenement; ?>" >
 
        <button class="fill_button">OUI</button>  </a>
      </div>
      </div> 
          <div class="reveal" id="modal_ajout_evenement" data-reveal> 

            <div class="row">
              
                <div class="columns large-12 medium-12 small-12">
                  <h5>Ajout d'un &eacutev&eacutenement</h5>
                </div>

              
                <?php echo form_open_multipart('event/index','class=""');?> 
                <div class="columns large-6 medium-6" align="center">
                 <!--  <div class="col-sm-3 text-center">
                    <div class="form-group">
                      <label for="avatar">Ajouter une image descriptif .. </label>
                      <input type="file" id="avatar" name="userfile" style="word-wrap: break-word"/>
                    </div>
                  </div> -->
                  <div class="columns large-12 medium-12">
                  <label for="avatar" class="fill_button" > <i class="fas fa-camera 4x"></i> ajouter une image descriptive</label>
    
    <input type="file" id="avatar" class="show-for-sr" name="userfile" ">
    </div>
    
                <div class="columns large-12 medium-12">
                  <label>Description
                    <textarea cols="10" name="descEvent" rows="5"></textarea>
                  </label>
                </div>   
                </div>       
                
                <div class="columns large-6 medium-6">
                  <div class="columns large-12 medium-12">
                  <input type="text" name="titreEvent" placeholder="Entrez le nom " class="custom_input">
                  <input type="text" name="lieuEvent" placeholder="Lieux/Adresse de " class="custom_input">
                  <label>Date debut
                  <input type="datetime-local" name="datedebutEvent" class="custom_input">
                  </label>
                  <label>Date fin
                  <input type="datetime-local" name="datefinEvent" class="custom_input">
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
                    <input type="number" name="prix" placeholder="GDES HT">
                  </div>
                  <div class=" columns large-8 medium-8 small-8">
                    <label>Point de vente</label>
                    <input type="text" name="pointDevente" placeholder="Entrez un Point de vente">
                  </div>
                  <input class="fill_button" type="submit" id="addEvent" name="addEvent" value="Ajouter"/> 
                </div>
                </div>

                <?php echo form_close();  ?>
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
          </div>

          <!-- Fin modal ajout_evenement -->

           <?php $req = $this->evenement_model->lister(); ?>
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
                <div class="columns large-6 medium-6"  style= "border 2px solid; "align="center">
               <!--    <div class="columns medium-12 large-12">
                    <div class="form-group">
                      <label for="avatar">Ajouter une image descriptif .. </label>
                      <input type="file" id="avatar" name="userfile" style="word-wrap: break-word">
                    </div>
                  </div> -->
                  <div class="columns large-12 medium-12">
                  <label for="avatar" class="fill_button" > <i class="fas fa-camera 4x"></i> ajouter une image descriptive</label>
    
    <input type="file" id="avatar" class="show-for-sr" name="userfile" ">
    </div>
                <div class="columns large-12 medium-12">
                  <label>Description
                    <textarea cols="10" name="descEvent" value="<?php echo $key->description; ?>" rows="5"></textarea>
                  </label>
                </div>  
                </div> <?php // echo var_dump($key->idevenement); ?>
                
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




