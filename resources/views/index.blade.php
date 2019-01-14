<!doctype html>
<html lang="en">
<head>
	<meta name="robots" content="noindex, nofollow, noarchive">
	<meta charset="utf-8">
	<title>OVH KIMSUFI Stock Checker</title>
	<link rel="stylesheet" href="/res/bootstrap.min.css">
</head>

<body>

	<div class="container my-2 text-center">
		<h1>OVH / KS Stock Checker</h1>
			<p>Sign up for email notifications for when a server is next in stock</p>

@if( Session::has( 'message' ))
		<div class="alert alert-info my-2">
			<div class="py-2 font-weight-bold">{{ Session::get( 'message' ) }}</div>
		</div>
@endif

		<div class="row d-flex justify-content-center align-items-center text-left my-4">
			<div class="col-md-4">
				<form method="get" action="/subscribe">
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" name="email">
					</div>
					<div class="form-group">
						<label for="server">Server</label>
						<select class="form-control" name="server">
							<option value="1801sk12">KS-1</option>
							<option value="1801sk13">KS-2</option>
							<option value="1801sk14">KS-3</option>
							<option value="1801sk15">KS-4</option>
							<option value="1801sk16">KS-5</option>
							<option value="1801sk17">KS-6</option>
							<option value="1801sk18">KS-7</option>
							<option value="1801sk19">KS-8</option>
							<option value="1801sk20">KS-9</option>
							<option value="1801sk21">KS-10</option>
							<option value="1801sk22">KS-11</option>
							<option value="1801sk23">KS-12</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>

		<table class="table table-striped table-bordered text-left">
			<thead>
				<th>Name</th><th>Specification</th><th>France</th><th>Price</th>
			</thead>
			<tbody>
@foreach ($servers as $s)
				<tr>
					<td>{{ $s->name }}</td>
					<td>{{ $s->spec }}</td>
@if ($s->available)
					<td><a href="https://www.kimsufi.com/en/order/kimsufi.xml?reference={{ $s->code }}" target="_blank" class="font-weight-bold">Available</a>

@if ($s->rbx)
	<div><strong>RBX</strong> ({{ $s->rbx }})</div>
@endif
@if ($s->gra)
	<div><strong>GRA</strong> ({{ $s->gra }})</div>
@endif
@if ($s->sbg)
	<div><strong>SBG</strong> ({{ $s->sbg }})</div>
@endif

@else
					<td>Not Available</td>
@endif
					<td>€{{ $s->price }}</td>
				</tr>
@endforeach
			</tbody>
		</table>
		
		<div class="footer py-2">
			<p><strong>GRA</strong> is Gravelines; <strong>RBX</strong> is Roubaix; <strong>SBG</strong> is Strasbourg</p>
			<p>Server stock is updated every 10 minutes</p>
		</div>
	</div>

<script src="/res/jquery.min.js"></script>
<script src="/res/bootstrap.bundle.min.js"></script>

</body>
</html>
