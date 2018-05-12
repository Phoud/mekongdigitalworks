<!DOCTYPE html>
<html>
<head lang="en">
	@include('admin/partial.adminheader')
</head>
<body class="hold-transition skin-blue sidebar-mini" id="top">
@include('admin/partial.navbar')
@yield('content')
@include('admin/common.asidebar')
@include('admin/partial.adminfooter')
</body>
</html>