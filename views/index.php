<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Fizzmod test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container">

	<label for="productId">Id de producto</label>
	<input type="text" name="productId" id="productId" />
	<input type="button" class="btn consult" value="CONSULTAR" />

	<br /><br />

	<input type="button" class="btn see-all" value="VER TODOS" />

	<input type="button" class="btn truncate" value="VACIAR TABLA (SERVER)" />
	<input type="button" class="btn seed" value="LLENAR TABLA (SERVER)" />

</div>

<div id="result">

	<p id="result-state" style="display: none"></p>

	<table id="result-table">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>price</th>
			</tr>
		</thead>
		<tbody id="result-body">

		</tbody>
	</table>
</div>

<a id="github-link" href="https://github.com/NicoGrapsas/ejercicio-fizzmod">Github</a>

<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/app.js"></script>

</body>
</html>