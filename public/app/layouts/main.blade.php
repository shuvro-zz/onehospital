<!DOCTYPE html>
<html ng-app="patholab_app">
<head>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<link rel="shortcut icon"  href="/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/include/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="/include/bootstrap/css/bootstrap-theme.css"/>
	<link rel="stylesheet" type="text/css" href="/include/fa/css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="/include/style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/services/dialogs/dialogs_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/services/processing-bar/processing-bar_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/login-form/login-form_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/operator/patient-list/patient-list_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/operator/tests-form/tests-form_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/operator/patient-form/patient-form_style.css"/>	
	<link rel="stylesheet" type="text/css" href="/app/operator/report-managment/report-managment_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/operator/patient-content/patient-content_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/patient/report-list/report-list_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/patient/report-details/report-details_style.css"/>
	<link rel="stylesheet" type="text/css" href="/app/patient/report-options/report-options_style.css"/>
	<link rel="stylesheet" type="text/css" href="/include/jquery-ui.css">
	<script type="text/javascript" src="/include/jquery.min.js"></script>
	<script type="text/javascript" src="/include/jquery-ui.js"></script>
	<script type="text/javascript" src="/include/bootstrap/js/bootstrap.min.js"></script>
	<script	type="text/javascript" src="/include/angular.min.js"></script>
	<script	type="text/javascript" src="/include/angular-messages.js"></script>
	<script type="text/javascript" src="/app/app.js"></script>
	<script type="text/javascript" src="/app/login-form/login-form_def.js"></script>
	<script type="text/javascript" src="/app/services/auth.js"></script>
	<script type="text/javascript" src="/app/services/patients.js"></script>
	<script type="text/javascript" src="/app/services/tests.js"></script>
	<script type="text/javascript" src="/app/services/reports.js"></script>
	<script type="text/javascript" src="/app/services/patientReports.js"></script>
	<script type="text/javascript" src="/app/services/reportsAsFile.js"></script>
	<script type="text/javascript" src="/app/services/dialogs/dialogs_def.js"></script>
	<script type="text/javascript" src="/app/services/processing-bar/processing-bar_def.js"></script>
	<script type="text/javascript" src="/app/operator/patient-list/patient-list_def.js"></script>
	<script type="text/javascript" src="/app/operator/patient-form/patient-form_def.js"></script>
	<script type="text/javascript" src="/app/operator/tests-form/tests-form_def.js"></script>
	<script type="text/javascript" src="/app/operator/patient-content/patient-content_def.js"></script>
	<script type="text/javascript" src="/app/operator/report-managment/report-managment_def.js"></script>
	<script type="text/javascript" src="/app/patient/report-list/report-list_def.js"></script>
	<script type="text/javascript" src="/app/patient/report-details/report-details_def.js"></script>
	<script type="text/javascript" src="/app/patient/report-options/report-options_def.js"></script>	
 	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>        
    </script> 
    @section('username')   
    @show
</head>
<body>
	<div class="container-fluid">
		@section('contents')
		@show
	</div>
</body>
</html>