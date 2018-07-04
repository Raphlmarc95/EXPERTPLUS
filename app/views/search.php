<div class="row" style="margin-top:2em;">

       <div class="large-12 medium-12 small-12" > 
        <h4 style="margin:0px; padding:0px; line-height:2.5px; "> R&eacutesultat de la recherche</h4>
        <hr/>
       </div>
       

    <?php if (isset($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type => $message):?>
        <div class="callout success<?= $type; ?>" style="position: absolute;">
          <?= $message; ?>            
        </div>
      <?php endforeach ?>
      <?php unset($_SESSION['flash']) ?>
    <?php endif ?>




	

<?php if($fetch) { ?>

	<?php foreach ($fetch as $key => $v ) :?> 
		<?php if (($v->type) === 'EVENEMENT') {?>
			<?php $req = "SELECT * FROM evenement WHERE idevenement = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {?>
				



				<?php }?>
			
				
		<?php }  ?>
		
		<?php if (($v->type) === 'OUVRAGE') {?>

			<?php $req = "SELECT a.*,b.pseudo FROM ouvrage a join membre b on a.id_membre=b.idmembre  and idouvrage = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {?>

					<div class="small-6 medium-4 large-2 " style="margin:0.85em;" >	
                       <div class="large-12 ouvrage">
                        <img src="<?php echo base_url('assets/img/'.$u->images); ?>" 
                      class="ouvrage thumbnail"/>
                       <div id="info_ouvrage">
                      <strong><?php echo $u->titre;?></strong><br />
                     <em> <?php echo $u->pseudo; ?></em>

                       </div>
                      </div>

                     

                   </div>
                  

				<?php }?>
		
				
		<?php }  ?>
		<?php if (($v->type) === 'MEMBRE') {?>
			<?php $req = "SELECT * FROM membre WHERE idmembre = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {?>	
				
                 <div class="column large-2 medium-4 small-5 auteurCadreInfo">
			    <div class="medium-12" style="padding:10px">
			    <a href="<?php echo base_url('auteur/info?id=').$u->idmembre?>">	
			    <?php if(empty($u->photo )){ ?>
	                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	              <?php } else {?>
	                 <img src="<?php echo base_url('assets/avatar/'.$u->photo ); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	            <?php } ?>
			  	</a>
			    </div>
				<div class="medium-12" style="background-color:#2e7f4d; padding: 8px; "> 
					<h5 style="margin-bottom:0px">  <?php echo $u->pseudo ?></h5>
				</div>
			  </div>	

				<?php } ?>
				
				
		<?php }  ?>


	<?php endforeach ?>
<?php } else {?>

	<div class="callout"> <h4>Aucun r&eacutesultat trouv&eacute<h4></div>
 
<?php } ?>
</div>