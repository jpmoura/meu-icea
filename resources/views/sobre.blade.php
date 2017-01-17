@extends('layout.base')

@section('title')
    Sobre o Meu ICEA
@endsection

@section('description')
    Um pouco sobre o sistema.
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <img src="{{asset('/img/stackholders.png')}}" alt="Stackholders do Sistema" class="center-block img-responsive"/>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p class="text-justify">
                O Portal <a><i class="fa fa-building-o"></i> Meu ICEA</a> foi idealizado afim de reunir
                todos os sistemas disponíveis as esferas discente, docente, técnica e
                administrativa de uma maneira simples ao usuário.
            </p>
            <p class="text-justify">
                Outra motivação foi usar o <em>login</em> único para todos os sistemas,
                usando as mesmas credenciais do sistema
                <a target="_blank" href="http://www.minha.ufop.br"><i class="fa fa-home">Minha UFOP</i></a>,
                com o intuito de evitar que o usuário fique lembrando de múltiplas
                credenciais e senhas para cada diferente sistema.
            </p>
            <p class="text-justify">
                O sistema de <em>login</em> único e portal <a><i class="fa fa-building-o"></i> Meu ICEA</a>
                foram implementados pelo bolsista <a target="_blank" href="https://www.github.com/jpmoura">João Pedro Santos de Moura</a>.
            </p>
        </div>
    </div>
@endsection