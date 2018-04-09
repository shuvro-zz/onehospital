@extends('app.layouts.main')
@section('title', 'Operator Platform')
@section('contents')
	<div style="position: absolute;height: 100%; width: 100%;z-index=1;">
		<div class="row">
			<div class="col-sm-6" style="padding: 50px">
				<patient-list></patient-list>
			</div>
			<div class="col-sm-6">
				<patient-form></patient-form>
			</div>
		</div>
	</div>
	<tests-form></tests-form>
	<report-managment></report-managment>
	<patient-content></patient-content>
	@endsection
