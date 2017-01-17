<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Meu ICEA - @yield('titulo')</title>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! HTML::style('css/bootstrap/bootstrap.min.css') !!}
    {!! HTML::style('css/font-awesome/font-awesome.min.css') !!}
    {!! HTML::style('css/app.css') !!}

    @stack('extra-css')

    {!! HTML::favicon('favicon.ico') !!}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-ufop hold-transition sidebar-mini @if(!Auth::check()) guest @endif">

<div class="wrapper">

    @include('layout.cabecalho')

    @include('layout.menulateral')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>@yield('titulo')
                <small>@yield('descricao')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Início</a></li>
                @yield('mapa')
            </ol>
        </section>

        <section class="content">
            @yield('conteudo')
        </section>
    </div>

    @include('layout.rodape')
</div>

{!! HTML::script('js/app.js') !!}

{{-- Scripts específicos da página --}}
@stack('extra-scripts')
