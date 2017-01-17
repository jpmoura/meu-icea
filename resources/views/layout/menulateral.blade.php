<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header text-center">SISTEMAS</li>
            <li><a href="{{ route('loginReserva') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span>Reserva de Salas</span></a></li>
            <li><a href="{{ route('loginSisNti') }}"><i class="fa fa-support" aria-hidden="true"></i><span>Chamadas de Suporte</span></a></li>

            {{-- Atualizar link de redirecionamento de login atuomático dos sistemas na próxima atualização
            <li><a href="#"><i class="fa fa-desktop" aria-hidden="true"></i><span>Cadastro de Endereço MAC</span></a></li>
            <li><a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i><span>Ajudaí</span></a></li>
            <li><a href="#"><i class="fa fa-cloud" aria-hidden="true"></i><span>ICEAbox</span></a></li>
            --}}

            <li class="header text-center">ATALHOS</li>
            <li><a target="_blank" href="http://www.minha.ufop.br"><i class="fa fa-home" aria-hidden="true"></i><span>Minha UFOP</span></a></li>
            <li><a target="_blank" href="http://www.moodlepresencial.ufop.br/moodle/login/index.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Moodle Presencial</span></a></li>
            <li><a target="_blank" href="http://www.icea.ufop.br/site/"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Site do ICEA</span></a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Sair</span></a></li>
        </ul>
    </section>
</aside>
