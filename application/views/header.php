<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CI CRUD v1.2</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
		<script type="text/javascript">
			$(this).ready( function() {
			    $("#id").autocomplete({
			        minLength: 1,
			        source: 
			        function(req, add){
			            $.ajax({
			                url: "<?php echo base_url(); ?>index.php/baranggay/lookup",
			                dataType: 'json',
			                type: 'POST',
			                data: req,
			                success:    
			                function(data){
			                    if(data.response =="true"){
			                        add(data.message);
			                    }
			                },
			            });
			        },
			    select: 
			        function(event, ui) {
			            $("#result").append(
			                "<li>"+ ui.item.value + "</li>"
			            );                  
			        },      
			    });
			});
			</script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-default" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
							</button> <a class="navbar-brand" href="<?php echo base_url(); ?>">Brand</a>
						</div>
						
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="active">
									<a href="#">Link</a>
								</li>
								<li>
									<a href="#">Link</a>
								</li>
								<li class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="#">Action</a>
										</li>
										<li>
											<a href="#">Another action</a>
										</li>
										<li>
											<a href="#">Something else here</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">Separated link</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">One more separated link</a>
										</li>
									</ul>
								</li>
							</ul>
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<!--input type="text" class="form-control"-->
									<?php
										if((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]=".base_url()."/baranggay
"){?>
											<input name="brgyDesc" value="" id="brgyCode"class="form-control" />
										<?php }
            							
        							?>
							        <ul>
							            <div id="result"></div>
							        </ul>
								</div> 
								<!--button type="submit" class="btn btn-default">
									Submit
								</button-->
							</form>
							<ul class="nav navbar-nav navbar-right">
								<li>
									<a href="#">Link</a>
								</li>
								<li class="dropdown">
									 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li>
											<a href="#">Action</a>
										</li>
										<li>
											<a href="#">Another action</a>
										</li>
										<li>
											<a href="#">Something else here</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">Separated link</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!--div class="row">
				<div class="col-md-12">
					<small><?php //echo $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?></small>
				</div>
			</div-->