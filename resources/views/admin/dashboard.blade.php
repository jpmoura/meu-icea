@extends('admin.admin_base')

  @section('page_title')
    Início
  @endsection

  @section('page_description')
    Bem vindo, você está na página inicial.
  @endsection

  @section('content')
    <div class="col-md-4">
      <div class="box box-primary-ufop">
        <div class="box-header text-center">
          <i class="fa fa-calendar-check-o"></i> Sistema de Reserva de Salas e Equipamentos
        </div>
        <div class="box-body">
          <div class="text-center">
            <a class="btn btn-app navy" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreReserva"><i class="fa fa-info-circle"></i>Sobre</a>
            <a class="btn btn-app" href="http://200.239.153.124/reserva/public/middleware/{{ Session::get('id') }}"><i class="fa fa-sign-in"></i>Entrar</a>
          </div>
        </div>
      </div>
    </div>
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
    <div class="col-md-4">
      <div class="box box-primary-ufop">
        <div class="box-header text-center">
          <i class="fa fa-support"></i> Chamadas de Suporte
        </div>
        <div class="box-body">
          <div class="text-center">
            <a class="btn btn-app" style="color: #1c8dbc" href="#" data-toggle="modal" data-target="#sobreSuporte"><i class="fa fa-info-circle"></i>Sobre</a>
            <a class="btn btn-app" href="#"><i class="fa fa-sign-in"></i>Entrar</a>
          </div>
        </div>
      </div>
    </div>

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
            <a class="btn btn-success" style="color: white" href="http://200.239.153.124/reserva/public/middleware/{{ Session::get('id') }}"><i class="fa fa-sign-in"></i> Entrar</a>
          </div>
        </div>
      </div>
    </div>

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
            <a class="btn btn-success" style="color: white" href="#"><i class="fa fa-sign-in"></i> Entrar</a>
          </div>
        </div>
      </div>
    </div>
  @endsection
