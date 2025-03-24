<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class Tasks extends Component
{
    public $tasks, $title, $taskId, $editing = false;

    public function mount()
    {
        $this->tasks = Task::latest()->get();
    }

    public function addTask()
    {
        $this->validate(['title' => 'required']);
        Task::create(['title' => $this->title]);
        $this->resetFields();
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->editing = true;
    }

    public function updateTask()
    {
        $this->validate(['title' => 'required']);
        Task::find($this->taskId)->update(['title' => $this->title]);
        $this->resetFields();
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
        $this->tasks = Task::latest()->get();
    }

    public function toggleCompletion($id)
    {
        $task = Task::find($id);
        $task->update(['completed' => !$task->completed]);
        $this->tasks = Task::latest()->get();
    }

    private function resetFields()
    {
        $this->title = '';
        $this->taskId = null;
        $this->editing = false;
        $this->tasks = Task::latest()->get();
    }

    public function render()
    {
        return view('livewire.tasks');
    }
}