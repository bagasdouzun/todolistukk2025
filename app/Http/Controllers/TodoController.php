<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query();

        // Filter berdasarkan priority
        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $todos = $query->paginate(10);

        return view('todos.index', compact('todos'));
    }

    public function welcome(Request $request)
    {
        // Ambil nilai filter prioritas dari input
        $priority = $request->input('priority');

        // Query untuk mengambil tugas yang sudah selesai dan sesuai prioritas jika ada filter
        $query = Todo::whereIn('status', ['Belum Selesai', 'Pending'])->where('user_id', Auth::id());

        if ($priority) {
            $query->where('priority', $priority);
        }

        // Ambil nilai filter prioritas dan status dari input
        $priority = $request->input('priority');
        $status = $request->input('status');

        // Query untuk mengambil tugas yang sudah selesai dan sesuai prioritas jika ada filter
        $query = Todo::whereIn('status', ['Belum Selesai', 'Pending'])->where('user_id', Auth::id());

        // Filter berdasarkan prioritas jika ada
        if ($priority) {
            $query->where('priority', $priority);
        }

        // Filter berdasarkan status jika ada
        if ($status) {
            // Pastikan status yang valid sesuai dengan kolom di database, misalnya 'completed' dan 'pending'
            $query->where('status', $status);
        }

        $approvedTodos = $query->get();

        return view('welcome', compact('approvedTodos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
        ]);

        Todo::create([
            'description' => $request->description,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('todos.index')->with('success', 'Task berhasil ditambahkan.');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
        ]);

        $todo->update([
            'description' => $request->description,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('todos.index')->with('success', 'Task berhasil diedit!');
    }


    public function selesai(Todo $todo)
    {
        $todo->status = 'Selesai';
        $todo->save();
        return redirect()->route('todos.index')->with('success', 'Task selesai berhasil.');
    }

    public function belum_selesai(Todo $todo)
    {
        $todo->status = 'Belum Selesai';
        $todo->save();
        return redirect()->route('todos.index')->with('success', 'Task belum selesai berhasil.');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Task berhasil dihapus!');
    }
}
