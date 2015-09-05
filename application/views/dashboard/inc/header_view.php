<!doctype html>
<html lang="en">
<head>
    <title>jrDash</title>
    <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>public/css/style.css" />

    <script src="<?=base_url()?>public/js/jquery.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap.js"></script>
    <script src="<?=base_url()?>public/js/jrdash/dashboard/result.js"></script>
    <script src="<?=base_url()?>public/js/jrdash/dashboard/event.js"></script>
    <script src="<?=base_url()?>public/js/jrdash/dashboard/template.js"></script>
    <script src="<?=base_url()?>public/js/jrdash/dashboard.js"></script>
    <script>
        $(function() {
            // Init the Dashboard application
            var dashboard = new Dashboard();
        });
    </script>

</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">jrDash</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="#">User</a></li>
                <li><a href="<?=site_url('dashboard/logout')?>">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--Start container-->
<div class="container">
    <div id="error_alert" class="alert alert-danger hidden" role="alert"></div>
    <div id="success_alert" class="alert alert-success hidden" role="alert"></div>