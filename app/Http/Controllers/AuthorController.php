<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [], ['name' => 'Nama Penulis']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Author::create($validator->validated());
        return redirect()->route('staff.authors.index')->with('success', 'Penulis berhasil ditambahkan');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [], ['name' => 'Nama Penulis']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $author->update($validator->validated());
        return redirect()->route('staff.authors.index')->with('success', 'Penulis berhasil diperbarui');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('staff.authors.index')->with('success', 'Penulis berhasil dihapus');
    }
}
?>
