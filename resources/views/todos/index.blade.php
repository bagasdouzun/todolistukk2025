@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <h1>To-Do List</h1>

    <!-- Filter Prioritas dan Status -->
    <form action="{{ route('todos.index') }}" method="GET" class="mb-3 d-flex align-items-end">
        <div class="form-group me-2">
            <label for="priority">Filter by Priority</label>
            <select class="form-control mt-1" name="priority" id="priority">
                <option value="">All</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="form-group me-2">
            <label for="status">Filter by Status</label>
            <select class="form-control mt-1" name="status" id="status">
                <option value="">All</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="belum selesai" {{ request('status') == 'belum selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Add New Task</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th> <!-- Kolom untuk nomor urut -->
                <th>Description</th>
                <th>Deadline</th>
                <th>Priority</th>
                <th>Status</th>
                <th style="width: 20%;">Actions</th>
                <th style="width: 15%;">Edit & Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $index => $todo)
            <tr>
                <td>{{ ($todos->currentPage() - 1) * $todos->perPage() + $index + 1 }}</td> <!-- Nomor urut melanjutkan -->
                <td>{{ $todo->description }}</td>
                <td>{{ $todo->deadline ? date('d M Y H:i', strtotime($todo->deadline)) : '-' }}</td>
                <td>{{ ucfirst($todo->priority) }}</td>
                <td>{{ ucfirst($todo->status) }}</td>
                <td>
                    <!-- Tombol Approve -->
                    <form action="{{ route('todos.selesai', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Selesai</button>
                    </form>

                    <!-- Tombol Reject -->
                    <form action="{{ route('todos.belum_selesai', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Belum Selesai</button>
                    </form>
                </td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $todos->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
