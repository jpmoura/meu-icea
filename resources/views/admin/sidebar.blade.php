<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header text-center">SISTEMAS</li>
          <li><a href="http://localhost/reserva/public/middleware/{{Session::get('id')}}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>Reserva de Salas</span></a></li>
          <li><a href="http://200.239.152.5/iceasgr/web"><i class="fa fa-desktop" aria-hidden="true"></i><span>Cadastro de Endereço MAC</span></a></li>
          <li><a href="http://200.239.152.5/sisnti/web"><i class="fa fa-support" aria-hidden="true"></i><span>Chamadas de Suporte</span></a></li>
          {{-- <li><a href="{{url('ajuda')}}"><i class="fa fa-question-circle" aria-hidden="true"></i><span>Ajuda</span></a></li> --}}
          <li class="header text-center">ATALHOS</li>
          <li><a target="_blank" href="http://www.minha.ufop.br"><i class="fa fa-home" aria-hidden="true"></i><span>Minha UFOP</span></a></li>
          <li><a target="_blank" href="http://www.icea.ufop.br/site/"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Site do ICEA</span></a></li>
          <li><a target="_blank" href="http://www.moodlepresencial.ufop.br/moodle/login/index.php"><i class="fa fa-graduation-cap"></i><span>Moodle Presencial</span></a></li>
          <li><a href="{{url('sair')}}"><i class="fa fa-sign-out"></i><span>Sair</span></a></li>
        </ul>

    </section>
</aside>
