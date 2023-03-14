<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/users/no-ava.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Администратор</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Онлайн </a>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Меню</li>
      <?php
      if($_SESSION['level_user'] == '1'){

        if(isset($_GET['courses'])) echo' <li class="active"> <a href="?courses"> <i class="fa fa-clipboard-list"></i> <span> Курсы </span> </a> </li>';
        else echo' <li> <a href="?courses"> <i class="fa fa-clipboard-list"></i> <span> Курсы </span> </a> </li>';

        if(isset($_GET['reviews'])) echo' <li class="active"> <a href="?reviews"> <i class="fa fa-comments"></i> <span> Отзывы </span> </a> </li>';
        else echo' <li> <a href="?reviews"> <i class="fa fa-comments"></i> <span> Отзывы </span> </a> </li>';

        if(isset($_GET['newsletter'])) echo' <li class="active"> <a href="?newsletter"> <i class="fa fa-envelope-open-text"></i> <span> Подписаться на поиск </span> </a> </li>';
        else echo' <li> <a href="?newsletter"> <i class="fa fa-envelope-open-text"></i> <span> Подписаться на поиск </span> </a> </li>';

        if(isset($_GET['setting'])) echo' <li class="active"> <a href="?setting"> <i class="fa fa-user-cog"></i> <span>Поменять пароль</span> </a> </li>';
        else echo' <li> <a href="?setting"> <i class="fa fa-user-cog"></i> <span>Поменять пароль</span> </a> </li>';
      
      }
      ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>