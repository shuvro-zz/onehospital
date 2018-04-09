@extends('app.layouts.main')
@section('title', 'Enter Credentials')
@section('username')
	@if(!empty($user))
		<script type="text/javascript">
			window.username = "{{ $user }}";
		</script>
	@endif
@endsection
@section('contents')
	<img src="/images/patholab.png" style="position: absolute;left:calc(50% - 100px);top:50px;height: 200px;width: 200px"/>
	<login-form></login-form>
@endsection