<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
       @Auth::check();
	?>
<?=(@template('components/head'))?>
<body class="dark bg-slate-900 text-slate-200">

<div class="flex h-screen">

 <?=(@template('components/asside'))?>

  <!-- Main Content -->
  <main class="flex-1 overflow-y-auto">

    <?=(@template('components/nav'))?>

    <section class="p-6 max-w-3xl">

      <!-- Group Form -->
      <div class="bg-slate-950 border border-slate-800 rounded-lg p-6 space-y-6">

        <div>
          <label class="block mb-2 text-sm">Status</label>
          <select id="status"  class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent" >
            <option value="" selected>Selecione um status</option>
            <?php
                    for($i =0 ; $i < sizeof($status); $i++)
                    {
                        if($status[$i]['id']!=1)
                        {
                            echo '<option value="'.$status[$i]['id'].'">'.$status[$i]['status'].'</option>';
                        }

                    }    
            ?>
        </select>
        </div>
        <div>
          <label class="block mb-2 text-sm">Nome</label>
          <input id="groupName" type="text" class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent" placeholder="Bugs & Melhorias" />
        </div>

        <div>$status = \App\Models\Status::all();
          <label class="block mb-2 text-sm">Descrição</label>
          <textarea id="groupDesc" class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent" placeholder="Manutenção de sistemas legados e.. "></textarea>
        </div>

        <!-- Users -->
        <div>
          <label class="block mb-2 text-sm">Grupos</label>
          <div class="grid grid-cols-2 gap-3" id="usersList"></div>
        </div>

        <button onclick="createGroup()" class="px-6 py-2 bg-accent text-slate-900 rounded hover:opacity-90">Salvar</button>
        <button  type="reset" class="px-6 py-2 bg-red-500 text-slate-900 rounded hover:opacity-90">Cancelar</button>

      </div>

      <!-- Output -->
      <div id="output" class="mt-6"></div>

    </section>
  </main>
</div>

<script>
// Mock users
const users = <?php echo json_encode($grupos); ?>

const usersList = document.getElementById('usersList');

users.forEach(user => {
  const label = document.createElement('label');
  label.className = 'flex items-center space-x-2 bg-slate-800 p-2 rounded cursor-pointer';

  label.innerHTML = `
    <input type="checkbox" value="${user.id}" class="accent-accent">
    <span>${user.name}</span>
  `;

  usersList.appendChild(label);
});

function createGroup() {
  const name = document.getElementById('groupName').value;
  const desc = document.getElementById('groupDesc').value;
  const selectedUsers = [...document.querySelectorAll('#usersList input:checked')]
    .map(input => input.value);

  if (!name) {
    Swal.fire("O nome do projeto é necessário!");
    return;
  }

   if (!desc) {
    Swal.fire("A descrição do projeto é necessária!");
    return;
  }

  if(!document.getElementById("status").value || document.getElementById("status").value =='')
  {
    Swal.fire("Por favor selecione um status válido!");
    return;
  }  

  const group = {
    name,
    desc,
    users: selectedUsers
  };

    form = new FormData();
    form.append('status',document.getElementById("status").value)
    form.append('name', name);
    form.append('descricao', desc);
    form.append('grupos',selectedUsers);
  
    return save(form);
 
}

async function save(form)
{
    const url="<?=url('add_projeto')?>";
    const response = await fetch(url,{method:'POST', body:form});
    if (response) 
    {
        const result = await response.text(); 
        if(result)
        {
            let resp = JSON.parse(result);

            if(resp['status']==202 ||resp['status']=='202' )
            {
                Swal.fire(resp['msg']);
                setTimeout(() => 
                {
                    window.location.href= "<?=url('projetos')?>";
                }, 5500);
            }    
        }            
    }
}
</script>

</body>
</html>