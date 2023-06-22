<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<!--Escolher a cor quando tiver texto preenchido nos inputs-->
<style>
input:-webkit-autofill 
{
    -webkit-box-shadow: 0 0 0 30px #e7fbe8d9 inset !important;
}
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>XML Reader</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/forms/selects/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/extensions/unslider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/weather-icons/climacons.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/charts/leaflet.css">
    <!-- END: Vendor CSS-->

	<!-- Date Picker -->
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/pickers/datetime/bootstrap-datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/pickers/pickadate/pickadate.css">

	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/vendors/css/tables/extensions/fixedHeader.dataTables.min.css">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/core/colors/palette-climacon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/fonts/meteocons/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/app-assets/css/pages/users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['app_url']; ?>/stack/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
