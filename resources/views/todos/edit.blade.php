@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="description">Task Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $todo->description }}" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="low" {{ $todo->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $todo->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $todo->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" class="form-control w-auto" id="deadline" name="deadline" value="{{ $todo->deadline ? date('Y-m-d\TH:i', strtotime($todo->deadline)) : '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update Task</button>
    </form>
</div>
@endsection
