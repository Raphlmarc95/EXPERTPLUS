<div class="row" style="margin-top:2.8em;">

  <div class="columns  small-12 medium-5 large-5 medium-centered" id="user" 
  style="justify-content: center;" >
  
        <?php  echo form_open('login/sign_in', 'class="columns medium-11 large-11"  ' ); ?>

            <?php if (isset($_SESSION['flash'])): ?>
                <?php foreach ($_SESSION['flash'] as $type => $message):?>
                  <div class="callout <?= $type; ?>" data-closable id="token" margin:auto; ">
                    <p><?= $message; ?></p>
                     <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                      <span aria-hidden="true">&times;</span>
                    </button>        
                  </div>
                <?php endforeach ?>
              <?php unset($_SESSION['flash']) ?>
            <?php endif ?>

            <div class="columns medium-12 small-12">
                

              <h5 style="margin-bottom:1.1em;">Connexion</h5>
              <p>Acceder a votre compte</p>

              <?php echo form_input('pseudo','','class="custom_input" name="pseudo" id="pseudo" placeholder="Nom d\'utilisateur" '); ?>
            </div>
            <div class="columns large-12">        
          
              <?php echo form_password('mot_de_passe','','class="custom_input" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" ') ?>
            </div>


       <div class="columns large-12"> 
              <span> <a href="<?php echo base_url('account/pass_fotgot'); ?>"> Mot de passe oubli&eacute?</a></span>
            </div>


             <div class="columns large-12"> 
            <input type="Submit" name="sign_in" value="Valider" class="fill_button" />
            </div>
            
               <div class="columns large-12" style="margin-top:0.4em;"> 
             <a href="<?php echo base_url('login/sign_up'); ?>"> 
              <input type="button" id="" class="border_button" name="sign_up" style="width:100%" value="Nouveau compte"/> </a>
            </div>
            
            
          </div>
        </div> <!-- end of container dropdown -->
      <?php echo form_close(); ?>
 
  <!-- end login connect -->
<?php // endif ?>


