<!DOCTYPE HTML>
	<?php 
		use \Core\Auth;
    @Auth::check();
	?>
<?=(@template('components/head'))?>
<body class="dark bg-slate-900 text-slate-200">

<div class="flex h-screen overflow-hidden">
  <?=(@template('components/asside'))?>
  <!-- Sidebar 
  <aside class="w-64 bg-slate-950 border-r border-slate-800 flex flex-col">
    <div class="px-6 py-4 text-xl font-bold text-accent">Kanban</div>
    <nav class="flex-1 px-4 space-y-2">
      <a class="block px-4 py-2 rounded bg-slate-800 text-accent">Dashboard</a>
      <a class="block px-4 py-2 rounded hover:bg-slate-800">Projects</a>
      <a class="block px-4 py-2 rounded hover:bg-slate-800">Tasks</a>
      <a class="block px-4 py-2 rounded hover:bg-slate-800">Settings</a>
    </nav>
  </aside>-->

  <!-- Main -->
  <main class="flex-1 overflow-y-auto">
    <header class="flex items-center justify-between px-6 py-4 border-b border-slate-800">
      <h1 class="text-2xl font-semibold">Kanban Board</h1>
      <button onclick="addTask()" class="px-4 py-2 bg-accent text-slate-900 rounded">+ New Task</button>
    </header>

    <!-- Board -->
    <section class="p-6">
      <div class="grid md:grid-cols-3 gap-6">

        <!-- Column -->
        <div class="column" data-status="todo">
          <h2 class="mb-3 font-semibold text-accent">To Do</h2>
          <div class="space-y-3 min-h-[200px] p-3 bg-slate-950 rounded border border-slate-800 dropzone"></div>
        </div>

        <div class="column" data-status="progress">
          <h2 class="mb-3 font-semibold text-yellow-400">In Progress</h2>
          <div class="space-y-3 min-h-[200px] p-3 bg-slate-950 rounded border border-slate-800 dropzone"></div>
        </div>

        <div class="column" data-status="done">
          <h2 class="mb-3 font-semibold text-green-400">Done</h2>
          <div class="space-y-3 min-h-[200px] p-3 bg-slate-950 rounded border border-slate-800 dropzone"></div>
        </div>

      </div>
    </section>
  </main>
</div>
<?=(@template('components/feet'))?>
<!-- JS -->
<script>
let taskId = 0;

function createTask(title) {
  const task = document.createElement('div');
  task.className = 'bg-slate-800 p-3 rounded cursor-move';
  task.draggable = true;
  task.id = 'task-' + taskId++;
  task.textContent = title;

  task.addEventListener('dragstart', e => {
    e.dataTransfer.setData('text/plain', task.id);
  });

  return task;
}

function addTask() {
  const title = prompt('Task title');
  if (!title) return;
  document.querySelector('[data-status="todo"] .dropzone')
    .appendChild(createTask(title));
}

// Drag & Drop
const zones = document.querySelectorAll('.dropzone');
zones.forEach(zone => {
  zone.addEventListener('dragover', e => e.preventDefault());
  zone.addEventListener('drop', e => {
    e.preventDefault();
    const id = e.dataTransfer.getData('text/plain');
    const task = document.getElementById(id);
    zone.appendChild(task);
  });
});

// Initial tasks
document.querySelector('[data-status="todo"] .dropzone')
  .appendChild(createTask('Design UI'));
document.querySelector('[data-status="progress"] .dropzone')
  .appendChild(createTask('Build API'));
document.querySelector('[data-status="done"] .dropzone')
  .appendChild(createTask('Project setup'));
</script>

</body>
</html>
