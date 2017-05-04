<div class="row">
	<div class="col-md-12">
		<h1>List of Baranggay</h1>
		<hr />
		<div class="table table-responsive">
	 		<?php echo $this->table->generate($records); ?>
	 		<?php echo $this->pagination->create_links(); ?>
	 	</div>
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</div>