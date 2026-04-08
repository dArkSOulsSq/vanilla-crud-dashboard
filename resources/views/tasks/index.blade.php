<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">✅ Задачи (Vanilla JS + Laravel API)</h1>
        
        <form id="taskForm" class="bg-white p-4 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" id="title" placeholder="Название" class="border p-2 rounded w-full" required>
            <textarea id="description" placeholder="Описание" class="border p-2 rounded w-full"></textarea>
            <select id="status" class="border p-2 rounded w-full">
                <option value="pending">В ожидании</option>
                <option value="in_progress">В работе</option>
                <option value="done">Готово</option>
            </select>
            <button type="submit" class="md:col-span-3 bg-green-600 hover:bg-green-700 text-white py-2 rounded">Добавить задачу</button>
        </form>

        <div id="taskList" class="space-y-3"></div>
    </div>

    <script src="{{ asset('js/tasks.js') }}"></script>
</body>
</html>