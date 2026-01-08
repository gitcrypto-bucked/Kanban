<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
       @Auth::check();
	?>
<?=(@template('components/head'))?>
<head>
           <script>
            
            function addGroup()
            {
                window.location.href = "<?=url('add_group')?>";
            }
        </script>
</head>
  <body class="bg-primary text-white font-sans">
    <div class="flex h-screen overflow-hidden">
    
         <?=(@template('components/asside'))?>

      <!-- Main Content -->
      <div class="flex-1 flex flex-col">
        <?=(@template('components/nav'))?>
        <!-- Top Bar -->
             

        <!-- User Table -->
        <main class="flex-grow p-6 overflow-y-auto">
            <header class="flex items-center px-6 py-4 border-b border-slate-800 flex justify-end">
                <button onclick="addGroup()" class="px-4 py-2 bg-accent text-slate-900 rounded">Novo grupo</button>
            </header>
          <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 "></h1>
            <div class="overflow-x-auto bg-gray-900 rounded-lg shadow-md">
              <?php if(isset($_SESSION['error']) && !is_null($_SESSION['error'])): ?>
                <div class="bg-red-500 text-white p-4 mb-2 rounded-md">
                    <?php echo $_SESSION['error']; ?>
                     <?php $_SESSION['error'] = null ;?>
                     <?php unset($_SESSION['error']); ?>
                </div>
              <?php endif; ?>
              <?php if(isset($_SESSION['success']) && !is_null($_SESSION['success'])): ?>
                <div class="bg-green-500 text-white p-4 mb-2 rounded-md">
                    <?php echo $_SESSION['success']; ?>
                    <?php $_SESSION['success'] = null; ?>
                     <?php unset($_SESSION['success']); ?>
                </div>
              <?php endif; ?>
              <table class="min-w-full text-left px-6">
                <thead class="bg-gray-800 text-gray-400">
                  <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nome</th>
                    <th class="px-6 py-3">Descrição</th>
                    <th class="px-6 py-3">Qtd. Usuário(s)</th>
                    <th class="px-6 py-3">Ações</th>
                  </tr>
                </thead>
                <tbody class="text-white divide-y divide-gray-700">
                  <?php
                       
                          for($i = 0; $i < sizeof($grupos['items']); $i++)
                          {
                              echo '<tr class="">
                              <td class="px-6 py-4">'.$grupos['items'][$i]['id'].'</td>
                              <td class="px-6 py-4">'.$grupos['items'][$i]['nome'].'</td>
                              <td class="px-6 py-4">'.$grupos['items'][$i]['descricao'].'</td>
                              <td class="px-6 py-4">'.$grupos['items'][$i]['usarios'].'</td>';
                            

                              if(boolval(Auth::user()['admin']))
                              {
                                echo  '<td class="px-6 py-4 space-x-2 ">
                                    <a class="text-accent hover:underline text-sm"   href="'.url('grupos/edit/'.base64_encode($grupos['items'][$i]['id'])).'">Editar</a>
                                    <a class="text-red-400 hover:underline text-sm" href="'.url('grupos/delete/'.base64_encode($grupos['items'][$i]['id'])).'">Excluir</a>
                                  </td>
                                  </tr>';
                              }
                              
                          }
                       
                  ?>
                 
                </tbody>
              </table>
            </div>
                            <?=paginate($grupos)?>

          </div>
        </main>
 
        <?=(@template('components/feet'))?>
 
