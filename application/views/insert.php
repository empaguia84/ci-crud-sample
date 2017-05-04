		<script type="text/javascript" charset="utf-8">
			$(function() {			
				$("input:text").prop( "autocomplete", "off" );
				/*
				$('.input-group').each(function(){
					$(this).find('.form-control').change(function(){
						$(this).closest('div').removeClass('has-error');
						$(this).closest('div').hide('text-danger');
					});
				*/					
				});
			});				
		</script>
<div class="col-md-6">
	<h1>Add New User</h1>
		<?php 
		  	$image = array(
		    	'name'  =>  'userfile',
		    	'id'    =>  'userfile',
		    	'class' => 	'form-control'
		    );	     
		?>
		<?php echo form_open_multipart('add_form', 'id=upload_file', 'name=upload_file'); ?>
		<?php //echo form_open_multipart('upload/upload_image', 'id=upload_file');upload_file ?>
		<div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
			<label>Enter your username</label>			
			<input type="text" name="name" size="20" value="<?php echo set_value('name'); ?>" class="form-control" />
			<?php echo form_error('name'); ?>
		</div>
		<div class="form-group">
			<label>Enter your email</label>
			<input type="text" name="email" size="20"  value="<?php echo set_value('email'); ?>" class="form-control" />
			<?php echo form_error('email'); ?>
		</div>
		<div class="form-group">
			<label>Enter your Mobile</label>
			<input type="text" name="mobile" size="20"  value="<?php echo set_value('mobile'); ?>" class="form-control" />
			<?php echo form_error('mobile'); ?>
		</div>
		<div class="form-group">
			<label>Enter Your Address</label>
			<textarea name="address" rows="5" cols="20" class="form-control"><?php echo set_value('address'); ?></textarea>
			<?php echo form_error('address'); ?>
		</div>
		<div class="form-group">
			<label>Upload Image</label>
			<!--input type="file" name="userfile" class="form-control" /-->	
			<?php echo form_upload($image); ?>
			<?php //echo form_error('userfile'); ?>			
		</div>		
		<div class="form-group">
			<input type="submit" name="submit" value="Send" /></td>
		</div>
	</form>
</div>
