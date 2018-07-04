<div class="row" style="margin-top:2em;">
	<div class="columns large-12 medium-12 small-12" >
		<h3 style="text-align:center;">Bienvenue sur le forum Biblioplus</h3>
		<?php if (isset($_SESSION['flash'])): ?>
				<?php foreach ($_SESSION['flash'] as $type => $message):?>
					 <div class="alert alert-<?= $type; ?>">
							<?= $message; ?> 						
					 </div>
				<?php endforeach ?>
				<?php unset($_SESSION['flash']) ?>
			<?php endif ?>
	</div>

	<div class="columns large-12 medium-12 small-12">
		<div class="columns large-12 medium-3 small-12">
			<?php if ($this->session->userdata('pseudo') !== NULL) { ?>
				<button id="nouveauSujet" class="fill_button">Nouveau sujet</button> 
			<?php } else {?>
			<button id="ajouterSujet" class="fill_button"><i class="fa fa-plus"> </i>Nouveau sujet
			</button> 
			<?php }?>
		</div>



<div class="row" id="nouveau_sujet_view" >
	<div class="columns large-9 medium-9 large-centered medium-centered">

	
		<!-- <form class="columns large-12 medium-12" > -->
			<!-- REGISTRATION FORM -->
		    
		      <?php //endif ?>

		      <?php if (isset($_SESSION['flash'])): ?>
		        <?php foreach ($_SESSION['flash'] as $type => $message):?>
		           <div class="alert alert-<?= $type; ?>">
		              <?= $message; ?>            
		           </div>
		        <?php endforeach ?>
		        <?php unset($_SESSION['flash']) ?>
		      <?php endif ?>
		<?php echo form_open_multipart('forum/nouveau_sujet','class="columns medium-12 large-12"');?> 
			<div class="columns large-12 medium-12">			
				<h5>Poster votre nouveau sujet</h5>
			</div>
			<div class=" columns large-12 medium-12 ">
				
				<div class="columns large-12 medium-12"> 
				<label > Sujet
					<input type="text" name="tsujet" id="tsujet" placeholder="votre sujet" >	
					</label>				
				</div>				
			</div>

			<div class=" columns large-12 medium-12 ">
				
				<div class="columns large-9 medium-9">
				
					<?php $req = $this->forum_model->get_sujet_cat(); ?>
				   
                   
				    <select id="categorie" name="categorie">
				    	<option> Categorie </option>
				    	<?php foreach ($req as $rows) :?>

				      <option value="<?php echo $rows->contenu_c; ?>" ><?php echo $rows->contenu_c; ?></option>
				       <?php endforeach?>
				    </select>
				   
				</div>			
			</div>

			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Contenu</label>		
				</div>
				<div class="columns large-9 medium-9">					
			<textarea  rows="6" cols="50" placeholder="" name="tcontenue" class="tcontenue"></textarea>					
				</div>				
			</div>
			<div class="columns large-12 medium-12">
				<input type="submit" name="poster" value="Poster" class="fill_button" />
			</div>
			<?php echo form_close();  ?>
		<!-- </form> -->
	</div>	
	<hr>



		<div class="columns large-6 medium-6">
			
		</div>
	</div>
	<div class=" columns large-12 medium-12 small-12" >
		<table>
			<div class="columns large-12 medium-12 small-12" ;>
			<thead>
				<div class="columns large-12 medium-12 small-12">
					<tr>
						<div class=" columns large-4 medium-4 small-6">
							<th>Sujet</th>
						</div>
						<div class=" columns large-2 medium-2 small-3">
							<th>Categorie</th>
						</div>
						<div class=" columns large-3 medium-3 small-3">
							<th>Utilisateurs</th>
						</div>
						<div class=" columns large-1 medium-1 small-3">
							<th>r&eacuteponses</th>
						</div>
						<div class=" columns large-2 medium-2 small-3">
							<th>Date de creation</th>
						</div>						
					</tr>
				</div>				
			</thead>
			</div>

			<div class="columns large-12 medium-12 small-12">
			<tbody>
				<div class="columns large-12 medium-12 small-12">
						<?php foreach ($forums as $rows): ?>
							  
							<tr>
								<div class=" columns large-6 medium-6 small-6">
									<td>
										
											<a href="http://localhost/biblioplus/forum/view?s=<?php echo $rows->sujet ; ?>&id=<?php echo $rows->id; ?>">
											<span class="span_titre"><em /><?php echo $rows->sujet; ?></span> </a>
										
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td> 
										<h6><?php echo $rows->topics_cat->contenu_c; ?></h6>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<h6><?php echo $rows->topics_mem->pseudo; ?></h6>
									</td>
								</div> 
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php  echo $rows->count_posts; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<?php echo $rows->date_hres_creation; ?>
									</td>
								</div>						
							</tr>
						<?php endforeach ?>
				</div>				
			</tbody>
			</div>
        </table>
	</div>
 



</div>
</div>