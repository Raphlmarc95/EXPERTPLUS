<div class="row" id="forum_view">
	<div class="columns large-12 medium-12" id="entete">
		<h3 >Forum Biblioplus</h3>
		<?php if (isset($_SESSION['flash'])): ?>
				<?php foreach ($_SESSION['flash'] as $type => $message):?>
					 <div class="alert alert-<?= $type; ?>">
							<?= $message; ?> 						
					 </div>
				<?php endforeach ?>
				<?php unset($_SESSION['flash']) ?>
			<?php endif ?>
	</div>

	<div class="columns large-12 medium-12" style="position: relative; bottom: 10px; padding:0px;" >
		<div class="columns large-3 medium-3">
			<a href="<?php echo base_url('forum/nouveau_sujet'); ?>">Nouveau sujet</a> 
		</div>

		<div class="columns large-3 medium-3">
			<div class="columns large-9 medium-9">
				<?php $req = $this->forum->get_sujet_cat(); ?>
			    <select id="categorie" name="categorie">
			    	<option> Lister par cat&eacutegorie </option>
			    	<?php foreach ($req as $rows) :?>
			      <option id="cat" value="<?php echo $rows->contenu_c; ?>" ><?php echo $rows->contenu_c; ?></option>
			       <?php endforeach?>
			    </select>
			</div>			
		</div>

		<div class="columns large-6 medium-6">
			
		</div>
	</div>
	<div class=" columns large-12 medium-12 small-12" id="corps">
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
					<!-- <?php $req // = $this->forum->lister_sujet(); ?>
						<?php // foreach ($req as $rows): ?> --> <?php // var_dump($rows->repons); ?>
							<tr>
								<div class=" columns large-6 medium-6 small-6">
									<td>
										<p> <?php echo $sujet; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<h6 style="font-weight: bold;"><?php // echo $rows->contenu_c; ?></h6>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php // echo $rows->pseudo; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php // echo $rows->repons; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php // echo $rows->date_hres_creation; ?></p>
									</td>
								</div>						
							</tr>
						<?php // endforeach ?>
					<?php // endif ?>
				</div>				
			</tbody>
			</div>
        </table>
	</div>
</div>