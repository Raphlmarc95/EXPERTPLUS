


<!--   </div> -->

  <!-- page content -->



<!-- Begin of mailrecup -->
  


<div class="row" id="mail_recup">
<div class="columns small-12 medium-6 large-6 large-centered medium-centered"> 
      
  <!--  <form class="columns medium-12 large-12" style="text-align:center;" > -->
    <?php echo form_open('account/Pass_fotgot', 'class="columns medium-12 large-12" style="text-align:center;"'); ?>
   <div class="columns small-12 medium-12 "> 
   <h5>R&eacutecup&eacuteration de votre compte</h5>
<p style="text-align:center:"> Veuillez saisir votre adresse mail pour la r&eacuteinitialisation de votre mot de passe </p> </div>

     <?php if (isset($_SESSION['flash'])): ?>
        <?php foreach ($_SESSION['flash'] as $type => $message):?>
           <div class="alert alert-<?= $type; ?>">
              <?= $message; ?>            
           </div>
        <?php endforeach ?>
        <?php unset($_SESSION['flash']) ?>
      <?php endif ?>
    
     <div class="columns small-12 medium-12 "> 
    <input type="mail" name="email" id="email" placeholder="expertplus@biblio.com" class="custom_input" />
    </div>

    <div class="columns small-12 medium-12 "> 
    <input type="Submit" name="Pass_fotgot" value="Envoyer" class="fill_button" />
    </div>
    <?php echo form_close();  ?>
<!-- </form> -->
</div>





</div>





</div><!-- End of mailRecup -->




                 <!--  <script src="../../assets/node_modules/jquery/dist/jquery.js"></script>
                  <script src="../../assets/node_modules/what-input/dist/what-input.js"></script>
                  <script src="../../assets/node_modules/foundation-sites/dist/js/foundation.js"></script>
                  <script src="../../assets/js/app.js"></script> -->
                </body>
              </html>
       