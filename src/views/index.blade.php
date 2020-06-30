@extends('IntranetOne::io.layout.dashboard')

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('io/services/io-provider.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('io/css/io-category.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pickadate-full.min.css') }}">
@stop

@section('main-heading')
@stop

@section('main-content')
	<!--section ends-->
			@component('IntranetOne::io.components.nav-tabs',
			[
				"_id" => "default-tablist",
				"_active"=>0,
				"_tabs"=> [
					[
						"tab"=>"Listar",
						"icon"=>"ico ico-list",
						"view"=>"Provider::table-list",
					],
					[
						"tab"=>"Cadastrar",
						"icon"=>"ico ico-new",
						"view"=>"Provider::form"
					],
				]
			])
			@endcomponent
	<!-- content -->
  @stop

  @section('after_body_scripts')
  @endsection

@section('footer_scripts')
  <script src="{{ asset('js/pickadate-full.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('io/js/io-category.min.js') }}"></script>
	<script src="{{ asset('io/services/io-provider-babel.min.js') }}"></script>
  <script src="{{ asset('io/services/io-provider-mix.min.js') }}"></script>
@stop
