@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Task</h1>
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Task Description</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" class="form-control w-auto" id="deadline" name="deadline" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Add Task</button>
    </form>
</div>
@endsection
