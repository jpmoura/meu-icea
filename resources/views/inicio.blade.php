@extends('layout.base')

@section('titulo')
    Início
@endsection

@section('descricao')
    Bem-vindo {!! auth()->user()->nome !!}, você está na página inicial.
@endsection

@section('conteudo')
    @if(!$errors->isEmpty())
        <div class="row">
            <div class="col-md-12">
                <div class="text-center alert alert-dismissible alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                    <strong>Erro!</strong>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    {{-- Alterar tamanho da coluna para md-4 na próxima atualização de quantidade de sistemas --}}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary-ufop">
                <div class="box-header text-center">
                    <i class="fa fa-calendar-check-o"></i> Sistema de Reserva de Salas e Equipamentos
                </div>
                <div class="box-body">
                    <div class="text-center">
                        <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreReserva"><i class="fa fa-info-circle"></i>Sobre</a>
                        <a class="btn btn-app btn-ufop" href="{{ route('loginReserva') }}"><i class="fa fa-sign-in"></i>Entrar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary-ufop">
                <div class="box-header text-center">
                    <i class="fa fa-support"></i> Sistema de Chamadas de Suporte
                </div>
                <div class="box-body">
                    <div class="text-center">
                        <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreSuporte"><i class="fa fa-info-circle"></i>Sobre</a>
                        <a class="btn btn-app btn-ufop" href="{{ route('loginSisNti') }}"><i class="fa fa-sign-in"></i>Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- A ser implementado
    <div class="col-md-4">
      <div class="box box-primary-ufop">
        <div class="box-header text-center">
          <i class="fa fa-desktop"></i> Solicitação de Cadastro de Endereço MAC
        </div>
        <div class="box-body">
          <div class="text-center">
            <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreMac"><i class="fa fa-info-circle"></i>Sobre</a>
            <a class="btn btn-app" href="#"><i class="fa fa-sign-in"></i>Entrar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="box box-primary-ufop">
          <div class="box-header text-center">
            <i class="fa fa-share-alt"></i> Ajudaí
          </div>
          <div class="box-body">
            <div class="text-center">
              <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreAjuda"><i class="fa fa-info-circle"></i>Sobre</a>
              <a class="btn btn-app" href="#"><i class="fa fa-sign-in"></i>Entrar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary-ufop">
          <div class="box-header text-center">
            <i class="fa fa-cloud"></i> ICEAbox
          </div>
          <div class="box-body">
            <div class="text-center">
              <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreCloud"><i class="fa fa-info-circle"></i>Sobre</a>
              <a class="btn btn-app" href="#"><i class="fa fa-sign-in"></i>Entrar</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    --}}


    <div class="modal fade" id="sobreReserva" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Sobre o Sistema de Reserva</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center"><i class="fa fa-calendar-check-o fa-3x"></i></p>
                    <p class="text-justify">
                        Aqui o aluno pode verificar quais horários de quais laboratórios/recursos seu professor reservou para aulas específas
                        enquanto o corpo docente, técnico e administrativo pode fazer reservas dos recursos atualmente disponíveis.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    <a class="btn btn-success" style="color: white" href="{{ route('loginReserva') }}"><i class="fa fa-sign-in"></i> Entrar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sobreSuporte" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">Sobre o Sistema de Chamada de Suporte</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center"><i class="fa fa-support fa-3x"></i></p>
                    <p class="text-justify">
                        O sistema de chamadas de suporte pode ser usado por qualquer um que tenha algum vínculo com o ICEA,
                        seja estudante, professor, técnico ou do setor administrativo para abrir um pedido de suporte junto ao Núcleo
                        de Tecnologia da Informação do <em>campus</em> em questões que estejam relacionadas a área da infraestrutura
                        de informática.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    <a class="btn btn-success" style="color: white" href="{{ route('loginSisNti') }}"><i class="fa fa-sign-in"></i> Entrar</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Atualizar modals de informação em próxima atualização de adição de sistemas

    <div class="modal fade" id="sobreMac" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-center">Sobre o Sistema de Cadastro de Endereço MAC</h4>
          </div>
          <div class="modal-body">
            <p class="text-center"><i class="fa fa-desktop fa-3x"></i></p>
            <p class="text-justify">
              Nesse sistema o corpo docente pode solicitar a liberação de um determinado endereço MAC, mediante da avaliação da justificativa
              e <em>upload</em> do termo de compromisso, de um dispositivo para que o mesmo tenha acesso à internet usando a rede sem fio
              ou cabeada do <em>campus</em>.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            <a class="btn btn-success" style="color: white" href="#"><i class="fa fa-sign-in"></i> Entrar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="sobreAjuda" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-center">Sobre o Ajudaí</h4>
          </div>
          <div class="modal-body">
            <p class="text-center"><i class="fa fa-share-alt fa-3x"></i></p>
            <p class="text-justify">
              O Ajudaí é um espaço dedicado para professores e alunos
              procurarem e/ou responderem dúvidas de outras pessoas
              sobre assuntos relacionados os tópicos lecionados
              nos cursos disponíveis no <em>campus</em>.
            </p>

            <p>Clique <a href="#">aqui</a> para saber mais ainda.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            <a class="btn btn-success" style="color: white" href="#"><i class="fa fa-sign-in"></i> Entrar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="sobreCloud" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-center">Sobre o ICEAbox</h4>
          </div>
          <div class="modal-body">
            <p class="text-center"><i class="fa fa-cloud fa-3x"></i></p>
            <p class="text-justify">
              ICEAbox é um repositório de arquivos instalado nos servidores dentro do <em>campus</em>
              com o objtivo de fornecer um espaço, <b>somente para o corpo docente e técnico</b>, um
              local de armazenamento confiável e que não dependa de redes externas ao <em>campus</em>
              para funcionar.
            </p>
            <p class="text-justify">
              Todo usuário (técnico ou professor) possuem um espaço de amazenamento padrão de até 512MB.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            <a class="btn btn-success" style="color: white" href="#"><i class="fa fa-sign-in"></i> Entrar</a>
          </div>
        </div>
      </div>
    </div>
    --}}
@endsection
