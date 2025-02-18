@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        Welcome,
        @if(Auth::check())
            {{ Auth::user()->name }}
        @endif
    </h1>

    <h2>To-Do List Web Application</h2>

    @if(Auth::check())
        <!-- Filter Prioritas dan Status -->
        <form action="{{ route('welcome') }}" method="GET" class="mb-3 d-flex align-items-end">
            <div class="form-group me-2 pt-3">
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
                    <option value="belum selesai" {{ request('status') == 'belum selesai' ? 'selected' : '' }}>Belum Selesai</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    @else
        <!-- Pesan jika pengguna belum login -->
        <div class="alert alert-warning mt-4">
            Untuk menambahkan tugas, Anda harus login terlebih dahulu.
        </div>
    @endif

    <div class="row">
        @foreach ($approvedTodos as $todo)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $todo->description }}</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Status dengan warna -->
                            <p class="card-text mb-0">
                                <strong>Status :</strong>
                                @if($todo->status == 'Belum Selesai')
                                    <span class="badge bg-danger">{{ ucfirst($todo->status) }}</span>
                                @elseif($todo->status == 'Pending')
                                    <span class="badge bg-warning">{{ ucfirst($todo->status) }}</span>
                                @else
                                    <span class="badge bg-success">{{ ucfirst($todo->status) }}</span>
                                @endif
                            </p>
                            <!-- Priority dengan warna -->
                            <p class="card-text mb-0">
                                <strong>Priority :</strong>
                                @if($todo->priority == 'high')
                                    <span class="badge bg-danger">{{ ucfirst($todo->priority) }}</span>
                                @elseif($todo->priority == 'medium')
                                    <span class="badge bg-warning">{{ ucfirst($todo->priority) }}</span>
                                @else
                                    <span class="badge bg-success">{{ ucfirst($todo->priority) }}</span>
                                @endif
                            </p>
                            <p class="card-text mb-0"><strong>Deadline :</strong> {{ \Carbon\Carbon::parse($todo->deadline)->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
