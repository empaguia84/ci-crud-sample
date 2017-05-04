<?php  ?>extract($user); ?>	
<div class="col-md-4">
	<h1>Update User No. <?php echo $id; ?></h1>
	<hr />
	<?php echo form_open('edit/'.$id.'') ?>
		<div class="form-group">
			<label>Image</label><br />
			<img src="<?php echo base_url();?>assets/images/uploads/thumbnail/<?php echo $image; ?>" />
		</div>
		<div class="form-group">
			<label>Enter your username</label>
			<input type="text" name="name" size="20" value="<?php if
			(set_value('name')){ echo set_value('name'); } elseif(form_error('name')){ echo ''; } else{ echo $name; } ?>" class="form-control" />
			<?php echo form_error('name'); ?>
		</div>
		<div class="form-group">
			<label>Enter your email</label>
			<input type="text" name="email" size="20" value="<?php if
			(set_value('email')) echo set_value('email'); else echo $email; ?>" class="form-control" />
			<?php echo form_error('email'); ?>
		</div>
		<div class="form-group">
			<label>Enter your Mobile</label>
			<input type="text" name="mobile" size="20" value="<?php if
			(set_value('mobile')) echo set_value('mobile'); else echo $mobile; ?>" class="form-control" />
			<?php echo form_error('mobile'); ?>
		</div>
		<div class="form-group">
			<label>Enter Your Address</label>
			<textarea name="address" rows="5" cols="20" class="form-control"><?php if
			(set_value('address')) echo set_value('address'); else echo $address; ?></textarea>
			<?php echo form_error('address'); ?>
		</div>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="submit" name="submit" value="Update" /></td>
		</div>
	</form>
</div>	