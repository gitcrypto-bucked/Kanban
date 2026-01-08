<?php
 use \Facades\Route;
?>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php
      if(Route::is('blog'))
      {
          echo '<title>Blog</title>';
      }
      if(Route::is('dash'))
      {
          echo '<title>Dashboard</title>';
      }
      if(Route::is('admin'))
      {
          echo '<title>Gerenciar usuários</title>';
      }
      if(Route::is('users'))
      {
          echo '<title>Editar usuário</title>';
      }
      if(Route::is('grupos'))
      {
          echo '<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">';
          echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>';
          echo '<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>';
          echo '<title>Grupos</title>';
          echo '<link rel="stylesheet" type="text/css" href="'.asset('datatable.css').'">';
      }
      if(Route::is('projetos'))
      {
          echo '<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">';
          echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>';
          echo '<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>';
          echo '<title>Projetos</title>';
          echo '<link rel="stylesheet" type="text/css" href="'.asset('datatable.css').'">';
      }
       if(Route::is('add_projeto'))
      {
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo '<title>Criar Projeto</title>';
          echo '<link rel="stylesheet" type="text/css" href="'.asset('datatable.css').'">';
      }
      if(Route::is('add_group') ||Route::is('grupos') )
      {
          echo '<title>Criar Grupo</title>';
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      }
      unset($_SESSION['back']);
      $_SESSION['back'] = $_SERVER['HTTP_REFERER'];

  ?>
  <script src="https://cdn.tailwindcss.com"></script>
      <?=fontAwesome('7')?>
      <?=boostrapIcons()?>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: '#1e1e2f',
            accent: '#3b82f6',
          },
        },
      },
    };
  </script>
</head>
