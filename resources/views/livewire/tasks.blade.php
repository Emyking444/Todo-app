<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">📝 To-Do List</h2>

    <!-- Task Input -->
    <div class="flex mb-4">
        <input type="text" wire:model="title" class="w-full p-2 border rounded-md focus:outline-none" placeholder="Enter task">
        <button wire:click="{{ $editing ? 'updateTask' : 'addTask' }}" 
            class="ml-2 px-4 py-2 rounded-md text-white {{ $editing ? 'bg-blue-500' : 'bg-green-500' }}">
            {{ $editing ? 'Update' : 'Add' }}
        </button>
    </div>

    <!-- Task List -->
    <ul class="divide-y divide-gray-300">
        @foreach($tasks as $task)
        <li class="flex justify-between items-center py-2">
            <div class="flex items-center space-x-2">
                <input type="checkbox" wire:click="toggleCompletion({{ $task->id }})" class="w-5 h-5" {{ $task->completed ? 'checked' : '' }}>
                <span class="{{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                    {{ $task->title }}
                </span>
            </div>

            <div>
                <button wire:click="editTask({{ $task->id }})" class="px-2 py-1 bg-blue-500 text-white rounded-md">✏️</button>
                <button wire:click="deleteTask({{ $task->id }})" class="ml-2 px-2 py-1 bg-red-500 text-white rounded-md">🗑️</button>
            </div>
        </li>
        @endforeach
    </ul>

</div>
