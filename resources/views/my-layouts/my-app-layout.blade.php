
<!DOCTYPE html>						<!-- tipo de documento -->
<html >								<!-- elemento raíz -->
	<head>							<!-- cabecera (invisible) -->
		<meta charset="utf-8">		<!-- tipo de caracteres -->
		<title>@yield('title')</title>
		<link rel="stylesheet" href="/t-style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>	
	<body>							<!-- cuerpo de la página -->
		<div id="page">
			<div id="header">
				<h1>My Página Web</h1>
			</div>
			<div id="menu">
                @section('sidebar')
				<ul>
					<li>Link 1</li>
					<li>Link 2</li>
					<li>Link 3</li>
					<li>Link 4</li>
					<li>Link 5</li>
				</ul>
                @show
			</div>
			<div id="content">
            @section('content') {{-- nos sirve definir una sección con un contenido predeterminado --}}
                This is the master content.
            @show
			</div>
			<div id="footer">
				<a href="mailto:correo@dominio.com">correo@dominio.com</a><br>
				<a href="pagina2.html" target="_blank" title="ir a pagina 2">Pagina 2</a>
			</div>
			
		<div>
	</body>
</html>



