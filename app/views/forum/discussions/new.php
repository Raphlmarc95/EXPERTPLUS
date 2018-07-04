<?php  echo form_open('forum/comment','class = form-horizontal');?> 
			<div class="form-group">
<!-- 				 <label for="id" class="col-sm-2 control-label">Id </label> 
 -->				<div class="col-sm-10">
					Id <input class="form-control" rows="5" name="id" /> 
				</div>
				<div class="col-sm-10">
					comment <textarea class="form-control" rows="5" name="com_contenue" value="<?php // echo $rows->sujet; ?>"></textarea>
				</div>
			</div>

			<div class="form-group">
				<div  class="col-sm-offset-2 col-sm-10">
					<input type="submit" id="post" name="post" value="post">
				</div>
			</div>

	<?php echo form_close();  ?>
