document.addEventListener('DOMContentLoaded', () => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const form = document.getElementById('taskForm');
    const list = document.getElementById('taskList');

    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': token
    };

    const loadTasks = async () => {
        try {
            const res = await fetch('/api/tasks', { headers });
            const tasks = await res.json();
            list.innerHTML = tasks.map(t => `
                <div class="bg-white p-4 rounded shadow flex justify-between items-start" data-id="${t.id}">
                    <div>
                        <h3 class="font-semibold">${t.title}</h3>
                        <p class="text-gray-600 text-sm">${t.description || '—'}</p>
                        <span class="text-xs px-2 py-1 rounded mt-2 inline-block ${t.status === 'done' ? 'bg-green-100 text-green-800' : t.status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800'}">${t.status}</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="delete-btn text-red-500 hover:text-red-700">Удалить</button>
                    </div>
                </div>
            `).join('');
        } catch (err) { console.error(err); }
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            status: document.getElementById('status').value
        };
        try {
            await fetch('/api/tasks', { method: 'POST', headers, body: JSON.stringify(data) });
            form.reset();
            loadTasks();
        } catch (err) { alert('Ошибка сохранения'); }
    });

    list.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-btn')) {
            const id = e.target.closest('[data-id]').dataset.id;
            if (!confirm('Удалить задачу?')) return;
            await fetch(`/api/tasks/${id}`, { method: 'DELETE', headers });
            loadTasks();
        }
    });

    loadTasks();
});