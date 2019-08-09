<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="robots" content="noindex, nofollow">
<title>Mooringsts</title>
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/img/favicon.png') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">

<!-- Lineawesome CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/line-awesome.min.css') }}">

<!-- Chart CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/plugins/morris/morris.css') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">

<script src="{{ asset('public/assets/js/jquery-3.2.1.min.js') }}"></script>

<script src="{{ asset('public/assets/jquery.validate.js') }}"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
<![endif]-->

<style>
.error {
	color:red;
}
.fade:not(.show) {
	opacity: 1;
}
.alert {
	margin-bottom:0px!important;
	border-radius: 1px;
}
.alert-success {
	background-color: #aedcb2;
	border-color: #aedcb2;
	color: #000!important;
	position:fixed;
	top:3px;
	right:3px;
	padding: 15px 40px;
    z-index: 9999;
    font-size: 15px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}
.alert-warning {
	background-color: #f5dab1;
	border-color: #f5dab1;
	color: #000!important;
	position:fixed;
	top:3px;
	right:3px;
	padding: 15px 40px;
    z-index: 9999;
    font-size: 15px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}
.alert-danger {
	background-color: #f16565;
	border-color: #f16565;
	color: #000!important;
	position:fixed;
	top:3px;
	right:3px;
	padding: 15px 40px;
    z-index: 9999;
    font-size: 15px;
	box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
}
</style>

<script> 
	setTimeout(function() {
		$('#msg').hide('slow');
	}, 3000);
</script>