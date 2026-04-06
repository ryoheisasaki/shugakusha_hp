<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class BookController extends Controller {
    private function isAdmin(): bool {
        if (!session()->has('user.id')) {
            return false;
        }

        $user = User::find(session('user.id'));

        return $user && $user->is_admin;
    }

    public function index(): View {
        $books = Book::where('is_published', true)->get();
        return view('books', compact('books'));
    }

    public function show($id): View {
        $book = Book::findOrFail($id);
        return view('book_detail', compact('book'));
    }

    public function adminIndex(): View {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $books = Book::where('is_published', false)->get();

        return view('admin.books', compact('books'));
    }

    public function create() {
        if (!$this->isAdmin()) {
            abort(403);
        }

        return view('books.create');
    }

    public function store(Request $request) {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric',
            'size' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'description' => 'nullable|string',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'depth' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = true;

        Book::create($validated);

        return redirect('/books');
    }

    public function edit($id) {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $book = Book::findOrFail($id);
        return view('admin.book_edit', compact('book'));
    }

    public function update(Request $request, $id) {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric',
            'size' => 'nullable|string|max:255',
            'pages' => 'nullable|integer',
            'description' => 'nullable|string',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'depth' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'is_published' => 'nullable|boolean',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = $request->has('is_published');

        $book->update($validated);

        return redirect('/books/' . $id);
    }

    public function destroy($id) {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/books');
    }
}
