

<div class="row" id="contenair_contenu_sujet" >
	<div class="columns large-12 medium-12"  style="margin-top:2em;">
<div class="columns large-12 medium-12" >
		<h3>Forum Biblioplus/Discussions</h3>
		<hr>
</div>

         <div class="columns large-12 medium-12 small-12" id="box_sujet_poster">
     <?php if (isset($_SESSION['flash'])): ?>
		<?php foreach ($_SESSION['flash'] as $type => $message):?>
			<div class="alert alert-<?= $type; ?>">
				<?= $message; ?> 						
			</div>
		<?php endforeach ?>
		<?php unset($_SESSION['flash']) ?>
	<?php endif ?>
	    <div class=" columns large-12 medium-12" >
	    	<?php foreach ($forums as $rows): ?>  
		  <h6><?php echo $rows->sujet; ?> / <span class="span_description"><?php echo $rows->contenu_c ; ?></span>  </h6> 
	    </div>

	    <div class="columns large-12 medium-12 small-12">
	    	<span class="span_description"></span>
	    </div>
	  
	    <div class="columns large-12 medium-12 small-12" style="padding: 0px;">

	    	<div class="columns large-1 medium-1 small-2" style="padding: 0px; text-align: center; ">
	    	<div class="columns large-12 medium-12 small-12" >
		    	<?php if(empty($rows->sujet_membre->photo )){ ?>
	                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	              <?php } else {?>
	                 <img src="<?php echo base_url('assets/avatar/'.$rows->sujet_membre->photo); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	            <?php } ?>
	    	</div>
	    	<div class="columns large-12 medium-12 small-12">
	    	<span><?php echo $rows->sujet_membre->pseudo; ?></span>	
	    	</div>
	    	</div>

	    	<div class="columns large-10 medium-10 small-8" id="contenu_sujet">
	    	<p style="text-align: center;">
	    		<?php echo $rows->contenu_s; ?>
	    	<?php //endforeach ?>
	    	</p>
	    	</div>
	    	<?php if ($this->session->userdata('pseudo') !== null): ?>
	    		<div class="columns large-10 medium-10" style=" text-align:right">
		    		<input type="button" class="fill_button" id="show" value="Réagir" />
		    	</div>
	    	<?php endif ?>

	    	<script type="text/javascript">
	    		$('#show').click(function() {
	    			// body...
	    			$('#espace_de_reaction').slideToggle();

	    			$('#valider').click( function () {
	    				// body...
	    				$('#espace_de_reaction').hide(); 
	    			} )
	    		})
	    	</script>

	    </div>

	</div> 
	<div class="columns large-12 medium-12" id="espace_de_reaction">
	<?php if(isset($rows->sujet_valid)) :?>
		<?php $i = $rows->sujet_valid; ?>
		<?php foreach ($i as $key => $value): ?> <pre><?php // var_dump($rows->sujet_valid); ?></pre>
	<?php echo form_open_multipart('forum/comment','class=""'); ?>  
			<input type="hidden" name="id" id="id" value="<?php echo $rows->sujet_valid[$key]->id; ?>" />
			<input type="hidden" name="s" id="s" value="<?php echo $this->uri->segment(3); ?>" /> 
		<?php endforeach ?> <?php endif ?>		
		<div class="columns large-12 medium-12" >
	     <textarea placeholder="" name="tcontenue" class="tcontenue"></textarea>	
			<script>
				CKEDITOR.replace( 'comment' );
			</script>    
		</div>
	    <div class="columns large-12 medium-12">
			<input type="submit" name="poster" value="poster" id="custom_input_post" />
	    </div> 
	    <?php echo form_close();  ?>

	</div>

	<?php if(isset($rows->sujet_post)) :?>
		<?php $i = $rows->sujet_post; ?>
		<?php foreach ($i as $key => $value): ?> 
			

	<div class="columns large-12 medium-12 small-12" id="reaction" style="margin-top:2em;">
    	<div class="columns large-1 medium-1 small-2"style="padding: 0px; text-align: center; font-style: italic; color: gray;">
    	<div class="columns large-12 medium-12 small-12" >
		    	<?php if(empty($rows->sujet_membre->photo )){ ?>
	                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	              <?php } else {?>
	                 <img src="<?php echo base_url('assets/avatar/'.$value->photo ); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	            <?php } ?>
	    	</div>
    	<div class="columns large-12 medium-12 " >
    		<span><?php echo $rows->sujet_post[$key]->pseudo_poster; ?></span>
    	</div>
    	</div> 
    <div class="columns large-11 medium-11 small-10 " style="text-align: center; padding: 0px; "> 
    	<div class="columns large-12 medium-12" style="text-align: right;"><span class="mini"><?= $rows->sujet_post[$key]->date_hres_edition; ?> </div>
        <div class="columns large-12 medium-12"></span>
    	<p> <?php echo $rows->sujet_post[$key]->contenu_m  ?> </p>
    	</div> 
    </div>  

	</div>
	<?php endforeach ?>
    <?php endif ?>
    <?php endforeach ?>
	</div>

</div>
</body>
</html>