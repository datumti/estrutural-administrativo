<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!-- Favicon -->
	{{Html::favicon('images/icons/favicon.ico')}}
	
	<!-- External -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	
	<!-- CSS -->
	{{ Html::style('') }}

</head>
<body>
	@yield('content')
	
	{{ Html::script('') }}
	
	@yield('scripts')
</body>
</html>