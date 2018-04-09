<!DOCTYPE html>
<htm>
<head>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="/app/pdf/report_style.css"/>
	<style type="text/css">
		.container{	
			position: absolute;
			width: 730px;
			height: 900px;
		}
		.header {
			position: relative;
			height: 200px;
			width: 100%;
			background-color: #004488;
			color: white;
		}

		.tests {
			position: relative;
			margin-top: 10px;
			width: 100%;
			background-color: #eeeeee;	
		}
		.header img {
			position: absolute;
			height: 100px;
			width: 100px;
			top: 50px;
			right: 50px;
		}

		.header .name {
			font-size: 30px;
			font-weight: bold;
		}

		.header .title {
			position: absolute;
			top: 15px;
			left: 25px;
		}

		.test {
			position: relative;
			height: 130px;
			width: 620px;
			background-color: #004488;
			padding: 10px;
			border: 2px solid white;
			margin-top: 10px;
		}

		.test .title {
			font-weight: bold;
		}

		td {
			color: white;
			word-wrap: break-word; 
			word-break: break-all;
		}

		.long {
			width: 450px;
		}

		ul {
			list-style: none;			
		}

		li {
			

		}
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
			@section('image_path')
			@show
			<div class="title">
				<span class="name">{{ $data['patient']['user']}}</span><br>
				<span class="reportDetails">{{ $data['report']['name'] }}</span><br>
				<span class="reportDetails">{{ $data['report']['innerTests'] }} Reports</span>
			</div>
		</div>
		<div class="tests">
			<ul>
				@foreach ($data['tests'] as $test)
				<li>
					<div class="test">
							<table>
								<tbody>
									<tr>
										<td>
											<span class="title">Test Name: </span>
										</td>
										<td class="long"><span>
											{{ $test['name'] }}
										</span></td>
									</tr>
									<tr>
										<td>
											<span class="title">Test Date: </span>
										</td>
										<td class="long"><span>
											{{ $test['created_at'] }}
										</span></td>
									</tr>
									<tr>
										<td>
											<span class="title">Test Type: </span>
										</td>
										<td class="long"><span>
											{{ $test['type'] }}
										</span></td>
									</tr>					
									<tr>
										<td>
											<span class="title">Test Result: </span>
										</td>
										<td class="long"><span>
											{{ $test['result'] }}
										</span></td>
									</tr>
									<tr>
										<td>
											<span class="title">Test Comments: </span>
										</td>
										<td class="long"><span>
											{{ $test['comments'] }}
										</span></td>
									</tr>
								</tbody>
							</table>
						</div>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</body>
</html>