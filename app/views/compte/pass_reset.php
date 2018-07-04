<div class="row" id="mail_recup">
<div class="columns small-12 medium-5 large-5 large-centered"> 


     <?php if (validation_errors()): ?> 
       <div class="alert alert-danger">
          <?php echo validation_errors(); ?> 
       </div>
      <?php endif ?>
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

   <!-- <form class="columns medium-12 large-12" style="text-align:center;" > -->
    <?php  echo form_open('account/update_pass', 'class="columns medium-12 large-12" style="text-align:center;"  ' ); ?>
 <div class="columns small-12 medium-12 "> 
   <h5>R&eacuteinitialisation du mot de passe</h5>
 </div>

     <div class="columns small-12 medium-12"> 
   <!--  <input type="password" name="mailRec" placeholder="Nouveau mot de passe" class="custom_input" /> -->
    <?php echo form_password('mot_de_passe','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe" placeholder="Nouveau mot de passe"'); ?>
    </div>
    <div class="columns small-12 medium-12 "> 
    <!-- <input type="password" name="mailRec" placeholder="Confirmation du mot de passe" class="custom_input" /> -->
    <?php echo form_password('mot_de_passe_c','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe_c" placeholder="Confirmation du mot de passe" ') ?>
    </div>

    <div class="columns small-12 medium-12 "> 
    <input type="Submit" name="update_pass" value="Reinitialis&eacute" class="fill_button" />
    </div>
    <?php form_close(); ?>
</form>
</div>