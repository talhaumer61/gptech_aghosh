
<!doctype html>
<html class="fixed">

<head>

	<!-- BASIC -->
	<meta charset="UTF-8">
	<meta name="keywords" content="School Management Software"/>
	<meta name="description" content="Rudras School Management System">
	<meta name="author" content="PVS Systems Pvt Ltd">

	<title> Recover Password | Rudras School </title>

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css"/>
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css"/>
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" href="assets/stylesheets/theme.css"/>
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css"/>
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
	<script src="assets/vendor/modernizr/modernizr.js"></script>
	<script src="assets/vendor/jquery/jquery.js"></script>
	<link rel="shortcut icon" href="assets/images/favicon.png">
	
	<!-- SWEETALERT JS/CSS -->
	<link rel="stylesheet" href="assets/sweetalert/sweetalert_custom.css">
	<script src="assets/sweetalert/sweetalert.min.js"></script>

</head>
<body>
	<!-- START: PAGE -->
	<section class="body-sign appear-animation" data-appear-animation="fadeInLeft">

		<script type="text/javascript">
			jQuery( document ).ready( function ( $ ) {
				// VALIDATION FORM
				$( "form#login" ).validate( {
					rules: {
						email: {
							required: true,
							email: true
						},
					},
					messages: {
						email: {
							required: 'Please enter your email.'
						},
					},

					highlight: function ( label ) {
						$( label ).closest( '.form-group' ).removeClass( 'has-success' ).addClass( 'has-error' );
					},
					success: function ( label ) {
						$( label ).closest( '.form-group' ).removeClass( 'has-error' );
						label.remove();
					},
					errorPlacement: function ( error, element ) {
						var placement = element.closest( '.input-group' );
						if ( !placement.get( 0 ) ) {
							placement = element;
						}
						if ( error.text() !== '' ) {

							if ( element.parent( '.checkbox, .radio' ).length || element.parent( '.input-group' ).length ) {
								placement.after( error );
							} else {
								var placement = element.closest( 'div' );
								placement.append( error );
								wrapper: "li"
							}

						}
					},

					submitHandler: function ( form ) {
						$.ajax( {
							url: 'recover/reset',
							method: 'POST',
							dataType: 'json',
							data: {
								email: $( "#email" ).val(),
							},
							success: function ( resp ) {
								
								if ( resp.status == 'true' ) {
									swal({ 
										title: "Successfully",
										text: "Password Reset Link Sent By Email !",
										type: "success" }, 
										function(){
											location.href = '';
										}
									);

								} else {
									swal({ 
										title: "Unsuccessful",
										text: "Email Not Found, Enter a Valid Email !",
										type: "error"
									});
								}
							}
						});
					}
				});

			});
		</script>

		<div class="center-sign">
			<div class="errors-container"></div>
			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Recover Password</h2>
				</div>
				<div class="panel-body">
					<div class="text-center">
						<div class="mb-lg"><img src="uploads/logo.png" height="54" alt="Shivas School"/>
						</div>
						<h4> School Management System ERP </h4>
					</div>
					<div class="alert alert-info">
						<p class="m-none text-weight-semibold h6">Enter your e-mail below and we will send you reset instructions!</p>
					</div>
					<form method="post" id="login" class="validate">
						<div class="form-group mb-none">
							<div class="input-group">
								<input name="email" id="email" type="email" placeholder="E-mail" class="form-control input-lg"/>
								<span class="input-group-btn">
									<button class="btn btn-primary btn-lg" type="submit">Reset!</button>
								</span>
							</div>
						</div>
						<div class="text-center mt-lg">
							<a href="signin"> <i class="fa fa-long-arrow-left mr-xs"></i>
								Return To Login Page ?
							</a>
						</div>
					</form>
				</div>
			</div>
			<p class="text-center text-muted mt-md mb-md">
				© 2017 School Manager v2.5 - Developed by <strong>BFTECH.</strong>			</p>
		</div>
	</section>

	<script src="assets/vendor/jquery-appear/jquery-appear.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
	<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
	<script src="assets/javascripts/theme.js"></script>
	<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
	<script src="assets/javascripts/theme.js"></script>
	<script src="assets/javascripts/theme.custom.js"></script>
	<script src="assets/javascripts/theme.init.js"></script>

</body>
</html>