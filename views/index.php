<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Fizzmod test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">

	<label for="productId">Id de producto</label>
	<input type="text" name="productId" id="productId" />
	<input type="button" class="btn consult" value="CONSULTAR" />

	<br /><br />

	<input type="button" class="btn see-all" value="VER TODOS" />

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

	<script src="/js/jquery-3.3.1.min.js"></script>
	<script src="/js/app.js"></script>
</body>
</html>