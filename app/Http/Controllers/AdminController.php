<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\UserBook;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function index()
    {
        //$currentUser = auth()->user();
        $all_books = Book::all();
        return view('admin.index', compact('all_books'));
    }

    public function index_users(){
        $current_user_id = Auth::id();
        $all_users = User::where('user_role', '!=', 'admin')
                 ->get();
        return view('admin.index_users', compact('all_users'));
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        // Delete the book's photo
        if ($book->cover_image && $book->cover_image!= 'default.webp') {
            Storage::delete('public/images/' . $book->cover_image);
        }
        // Delete the book's PDF
        if ($book->pdf_file) {
            Storage::delete('public/pdfs/' . $book->pdf_file);
        }
        $book->delete();
        return redirect('/admin/books')->with('success', 'The book has been deleted successfully!');
    }

    public function delete_user($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
        }
        return redirect()->back()->with('error', 'Utilisateur non trouvé.');
    }

    public function updateCheckbox(Request $request, $id)
    {
        $isChecked = $request->input('isChecked');
        $book = Book::findOrFail($id);

        if ($isChecked && $book->approved == 0) {
            $book->approved = 1;
        } else {
            $book->approved = 0;
        }
        $book->save();
    }

    public function updateCheckboxRole(Request $request, $id)
    {
        $isChecked = $request->input('isChecked');
        $user = User::findOrFail($id);

        if ($isChecked && $user->user_role == 'amateur') {
            $user->user_role = 'professional';
        } else {
            $user->user_role = 'amateur';
        }
        $user->save();
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.book', compact('book'));
    }

    public function showProfile(User $user)
    {
        return view('admin.profile', compact('user'));
    }


    public function deleteComment($id)
    {
        // Find the comment by ID
        $comment = Comment::findOrFail($id);

        // Delete the comment
        $comment->delete();

        return redirect()->back()->with('success', 'Comment has been deleted.');
    }

}
