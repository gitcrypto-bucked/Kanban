<?php
include_once("App/Config.php");
include_once("App/Model.php");

$model = new Model();
$afazer = $model->get('projetos',  'uid, titulo, tarefa, dataHoraCadastro ',
                                   ' todo="1" and ongoing="0" and done="0" and gone="0"', 'dataHoraCadastro DESC', '');

$ongoing =  $model->get('projetos',  'uid, titulo, tarefa, dataHoraCadastro ',
                                      ' todo="0" and ongoing="1" and done="0" and gone="0"', 'dataHoraCadastro DESC', '');

$done =  $model->get('projetos',  'uid, titulo, tarefa, dataHoraCadastro ',
                                      ' todo="0" and ongoing="0" and done="1" and gone="0"', 'dataHoraCadastro DESC', '');

$gone=  $model->get('projetos',  'uid, titulo, tarefa, dataHoraCadastro ',
                                      ' todo="0" and ongoing="0" and done="0" and gone="1"', 'dataHoraCadastro DESC', '');
?>
<!DOCTYPE php>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Kanban Board</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Arbutus+Slab'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!-- Simple MDL Progress Bar -->
<div id="p1" class="mdl-progress mdl-js-progress"></div>
<script>
  document.querySelector('#p1').addEventListener('mdl-componentupgraded', function() {
    this.MaterialProgress.setProgress(44);
  });
</script>
<div class="kanban__title">
    <h1><i class="material-icons">check</i> Lista de Tarefas</h1>
</div>
<div class="dd" id="main" name='main'>
  <!-- kanban to do -->
  <ol class="kanban To-do" id='todo' name='todo'>
    <div class="kanban__title">
        <h2><i class="material-icons">report_problem</i> A fazer</h2>
    </div>
    <!-- to do list -->
     <?php 
            global $afazer;
            if(empty($afazer))
            {
                echo '<li class="dd-item" data-id="0"  id="0" name="0">
                        <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> Sem tarefas</h4>
                        <div class="text" contenteditable="false"></div>
                        <div class="actions">
                        </div>
                    </li>';
            }
            else
            {
                for($i=0; $i<count($afazer); $i++)
                {
                     echo '<li class="dd-item" data-id="'.$afazer[$i]['uid'].'" id="'.$afazer[$i]['uid'].'"  name="'.$afazer[$i]['uid'].'">
                                <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> '.$afazer[$i]['titulo'].' </h4>
                                <div class="text" contenteditable="false" >'.$afazer[$i]['tarefa'].'</div>
                                <div class="actions">
                                </div>
                            </li>';
                }
            }
     ?>
     <!--to do list end -->
    <div class="actions">
      <button class="addbutt" onclick='createToDO()'><i class="material-icons">control_point</i> Nova</button>
    </div>
  </ol>
  <!--kanban ongoing -->
  <ol class="kanban progress" id='ongoing' name='ongoing'>
    <h2><i class="material-icons">build</i> Em andamento</h2>
    <!--start -->
    <?php 
        if(empty($ongoing))
        {
            
            echo '<li class="dd-item" data-id="0" id="0" name="0" >
                <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> Sem tarefas</h4>
                <div class="text" contenteditable="false"></div>
                <div class="actions">
                </div>
            </li>';
        }
        if(!empty($ongoing))
        {
            for($i=0; $i<count($ongoing); $i++)
                {
                     echo '<li class="dd-item" data-id="'.$ongoing[$i]['uid'].'" id="'.$ongoing[$i]['uid'].'"  name="'.$ongoing[$i]['uid'].'">
                                <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> '.$ongoing[$i]['titulo'].' </h4>
                                <div class="text" contenteditable="false" >'.$ongoing[$i]['tarefa'].'</div>
                                <div class="actions">
                                </div>
                            </li>';
                }
        }
    ?>
    <!--start --> 
    <div class="actions">
      <button class="addbutt" onclick='createOngoing()'><i class="material-icons">control_point</i>Nova</button>
    </div>
  </ol>
  <!--- kanban gone -->
  <ol class="kanban Done" id="done" name="done">
    <h2><i class="material-icons">check_circle</i> Feitos</h2>
      <?php 
            if(empty($done))
            {   
                echo '<li class="dd-item" data-id="0" id="0" name="0" >
                    <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> Sem tarefas</h4>
                    <div class="text" contenteditable="false"></div>
                    <div class="actions">
                    </div>
                </li>';
            }
            if(!empty($done))
            {
                for($i=0; $i<count($done); $i++)
                {
                     echo '<li class="dd-item" data-id="'.$done[$i]['uid'].'" id="'.$done[$i]['uid'].'"  name="'.$done[$i]['uid'].'">
                                <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> '.$done[$i]['titulo'].' </h4>
                                <div class="text" contenteditable="false" >'.$done[$i]['tarefa'].'</div>
                                <div class="actions">
                                </div>
                            </li>';
                }
            }
      ?>
    <div class="actions">
      <button class="addbutt" onclick='createDone()'><i class="material-icons">control_point</i>Nova</button>
    </div>
  </ol>
<!-- kanban gone-->
    <ol class="kanban Gone" id="gone" name="gone">
        <h2><i class="material-icons">delete</i> Encerradas</h2>
         <?php 
            if(empty($gone))
            {   
                echo '<li class="dd-item" data-id="0" id="0" name="0" >
                    <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> Sem tarefas</h4>
                    <div class="text" contenteditable="false"></div>
                    <div class="actions">
                    </div>
                </li>';
            }
            if(!empty($gone))
            {
                for($i=0; $i<count($gone); $i++)
                {
                     echo '<li class="dd-item" data-id="'.$gone[$i]['uid'].'" id="'.$gone[$i]['uid'].'"  name="'.$gone[$i]['uid'].'">
                                <h4 class="title dd-handle"><i class=" material-icons ">filter_none</i> '.$gone[$i]['titulo'].' </h4>
                                <div class="text" contenteditable="false" >'.$gone[$i]['tarefa'].'</div>
                                <div class="actions">
                                </div>
                            </li>';
                }
            }
      ?>
        <div class="actions">
            <button class="addbutt"  onclick="createGone()"><i class="material-icons">control_point</i> Nova</button>
        </div>
    </ol>
  </div>
<menu class="kanban">
  <!-- <button><i class="material-icons">settings</i></button>  -->
  <button><i class="material-icons">chevron_left</i></button>
  <button class="viewkanban"><i class="material-icons ">view_column</i></button>
  <button class="viewlist"><i class="material-icons">view_list</i></button>
  <!-- <button><i class="material-icons">playlist_add</i> Add new Column</button> -->
</menu>
<!-- partial -->
<!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script  src="./script.js"></script>
<script type='text/javascript'>
/*colors*/
$('#color').spectrum({
    color: "#f00",
    change: function(color) {
        $("#label").text("change called: " + color.toHexString());
    }
});

async function createToDO()
{
    Swal.fire({
    title: "Criar Tarefa",
    html:
      '<label for="swal-input1">Titulo</label>'+ 
      '<input id="swal-input1" class="swal2-input"><br>' +
      '<label for="swal-input2">Tarefa</label>'+ 
      '<input id="swal-input2" class="swal2-input">',
    inputAttributes: {
        autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Criar",
    showLoaderOnConfirm: true,
    preConfirm: async () =>
        { 
            if(document.getElementById('swal-input1').value=='')
            {
                Swal.fire('','O título precisa ser preenchido','error'); return;
            }
            if(document.getElementById('swal-input2').value=='')
            {
                Swal.fire('','O tarefa precisa ser preenchida','error'); return;
            }

            form = new FormData();
            form.append('titulo', document.getElementById('swal-input1').value);
            form.append('tarefa', document.getElementById('swal-input2').value);
            form.append('todo','1');
            form.append('ongoing','0');
            form.append('done','0');
            form.append('gone','0');

            const url='<?=Config::URL;?>/App/API.php';
            const response = await fetch(url,{method:'POST', body:form});
            if (response) 
            {
                const result = await response.text(); 
                console.log(result);
                if(result=='202' || result==202)
                {
                    location.reload();
                }
            }
        
        }
    });
}

async function createOngoing()
{
    Swal.fire({
        title: "Criar Tarefa",
        html:
      '<label for="swal-input1">Titulo</label>'+ 
      '<input id="swal-input1" class="swal2-input"><br>' +
      '<label for="swal-input2">Tarefa</label>'+ 
      '<input id="swal-input2" class="swal2-input">',
    inputAttributes: {
        autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Criar",
    showLoaderOnConfirm: true,
    preConfirm: async () =>
        { 
            if(document.getElementById('swal-input1').value=='')
            {
                Swal.fire('','O título precisa ser preenchido','error'); return;
            }
            if(document.getElementById('swal-input2').value=='')
            {
                Swal.fire('','O tarefa precisa ser preenchida','error'); return;
            }

            form = new FormData();
            form.apped('fn','new');
            form.append('titulo', document.getElementById('swal-input1').value);
            form.append('tarefa', document.getElementById('swal-input2').value);
            form.append('todo','0');
            form.append('ongoing','1');
            form.append('done','0');
            form.append('gone','0');

            const url='<?=Config::URL;?>/App/API.php';
            const response = await fetch(url,{method:'POST', body:form});
            if (response) 
            {
                const result = await response.text(); 
                console.log(result);
                if(result=='202' || result==202)
                {
                    location.reload();
                }
            }
        
        }
    });
}



async function createDone()
{
    Swal.fire({
        title: "Criar Tarefa",
        html:
      '<label for="swal-input1">Titulo</label>'+ 
      '<input id="swal-input1" class="swal2-input"><br>' +
      '<label for="swal-input2">Tarefa</label>'+ 
      '<input id="swal-input2" class="swal2-input">',
    inputAttributes: {
        autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Criar",
    showLoaderOnConfirm: true,
    preConfirm: async () =>
        { 
            if(document.getElementById('swal-input1').value=='')
            {
                Swal.fire('','O título precisa ser preenchido','error'); return;
            }
            if(document.getElementById('swal-input2').value=='')
            {
                Swal.fire('','O tarefa precisa ser preenchida','error'); return;
            }

            form = new FormData();
            form.append('titulo', document.getElementById('swal-input1').value);
            form.append('tarefa', document.getElementById('swal-input2').value);
            form.append('todo','0');
            form.append('ongoing','0');
            form.append('done','1');
            form.append('gone','0');

            const url='<?=Config::URL;?>/App/API.php';
            const response = await fetch(url,{method:'POST', body:form});
            if (response) 
            {
                const result = await response.text(); 
                console.log(result);
                if(result=='202' || result==202)
                {
                    location.reload();
                }
            }
        
        }
    });
}



async function createGone()
{
    Swal.fire({
        title: "Criar Tarefa",
        html:
      '<label for="swal-input1">Titulo</label>'+ 
      '<input id="swal-input1" class="swal2-input"><br>' +
      '<label for="swal-input2">Tarefa</label>'+ 
      '<input id="swal-input2" class="swal2-input">',
    inputAttributes: {
        autocapitalize: "off"
    },
    showCancelButton: true,
    confirmButtonText: "Criar",
    showLoaderOnConfirm: true,
    preConfirm: async () =>
        { 
            if(document.getElementById('swal-input1').value=='')
            {
                Swal.fire('','O título precisa ser preenchido','error'); return;
            }
            if(document.getElementById('swal-input2').value=='')
            {
                Swal.fire('','O tarefa precisa ser preenchida','error'); return;
            }

            form = new FormData();
            form.append('titulo', document.getElementById('swal-input1').value);
            form.append('tarefa', document.getElementById('swal-input2').value);
            form.append('todo','0');
            form.append('ongoing','0');
            form.append('done','1');
            form.append('gone','0');

            const url='<?=Config::URL;?>/App/API.php';
            const response = await fetch(url,{method:'POST', body:form});
            if (response) 
            {
                const result = await response.text(); 
                console.log(result);
                if(result=='202' || result==202)
                {
                    location.reload();
                }
            }
        
        }
    });
}
</script>
</body>
</html>
