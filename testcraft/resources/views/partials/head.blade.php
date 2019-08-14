<meta charset="utf-8">
<title>
    @lang('admin.ca_title')
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">
<meta name="csrf-token" content="{!! csrf_token() !!}">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Font Awesome -->
<link href="{{ url('quickadmin/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- Ionicons -->
<link href="{{ url('quickadmin/css/ionicons.min.css') }}" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/plugins/select2/select2.min.css') }}" rel="stylesheet">

<link href="{{ url('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/custom.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet">
<link href="{{ url('quickadmin/css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ url('quickadmin/css/select.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ url('quickadmin/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ url('quickadmin/css/jquery-ui-timepicker-addon.min.css') }}" rel="stylesheet">
<link href="{{ url('quickadmin/css/bootstrap-datepicker.standalone.min.css') }}" rel="stylesheet">

@yield('css')