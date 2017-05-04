	<body>
		<h2> My application Emerson Pogi </h2>
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th scope="col">Picture</th>
					<th scope="col">User Name</th>
					<th scope="col">Email</th>
					<th scope="col">Address</th>
					<th scope="col">Mobile</th>
					<th scope="col">Update</th>
					<th scope="col">Delete</th>
				</tr>
				<?php foreach ($user_list as $u_key){ ?>
				<tr>
					<td><img src="<?php echo base_url();?>assets/images/uploads/icon/<?php echo $u_key->image; ?>" height="32px" /></td>
					<td><?php echo $u_key->id; ?></td>
					<td><?php echo $u_key->name; ?></td>
					<td><?php echo $u_key->email; ?></td>
					<td><?php echo $u_key->address; ?></td>
					<td><?php echo $u_key->mobile; ?></td>
					<td width="40" align="left" ><a href="#" onClick="show_confirm('edit',<?php echo $u_key->id;?>)">Edit</a></td>
					<td width="40" align="left" ><a href="#" onClick="show_confirm('delete',<?php echo $u_key->id;?>)">Delete </a></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="7" align="right"> <a href="<?php echo base_url(); ?>index.php/users/add_form">Insert New User</a></td>
				</tr>
			</table>
		</div>
		<script>

			function show_confirm(act,gotoid){
				if(act=="edit")
					var r=confirm("Do you really want to edit?");
				else
					var r=confirm("Do you really want to delete?");
				if (r==true){
					window.location="<?php echo base_url(); ?>index.php/users/"+act+"/"+gotoid;
					}
				}

		</script>
