@extends('app.layouts.main')
@section('title', 'Patient Reports')
@section('contents')
	<div class="row">
		<div class="col-sm-12" style="font-size: 30px; color: white; background-color: #004488">
			Welcome, {{$person}}
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<report-list></report-list>
			<report-options ng-show="reportOptionsVisibility()"></report-options>
		</div>
		<div class="col-sm-6">
			<report-details></report-details>
		</div>
	</div>
@endsection