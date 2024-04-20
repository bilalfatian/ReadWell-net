<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\UserBook;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 

class BookController extends Controller
{
    

    /*
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }*/

    public function index()
    {
        //$currentUser = auth()->user();
        $all_books = Book::where('approved', true)
                 ->where('hidden', true)
                 ->get();

        return view('books.index', compact('all_books'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('books.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $book = new Book();
        //$book->user_id = auth()->user()->id;
        $book->user_id = Auth::id();
        $book->title = $request->input('title');
        $book->content = $request->input('content');
        $book->language = $request->input('language');

        if ($user->user_role=="amateur"){
            $book->approved = false;
        }else {
            $book->approved = true;
        }

        $book->hidden = true;
        $book->views = 0;
        $book->average_rating = 0;
    
        if ($request->hasFile('book_path')) {
            $pdf = $request->file('book_path');
            $pdf->store('public/pdf');
            $book->book_path = $pdf->hashName();
        } else {
            $book->book_path = '';
        }
    
        if ($request->hasFile('cover_image')) {
            $photo = $request->file('cover_image');
            $photo->store('public/images');
            $book->cover_image = $photo->hashName();
        } else {
            $book->cover_image = 'default.webp'; // Set default photo name
        }
    
        $book->save();
        return redirect('/books')->with('success', 'The book has been created successfully!');
    }    

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }


    public function show($id)
    {
        $book = Book::findOrFail($id);
        $id = Auth::id();
        $user = User::findOrFail($book->user_id);
        return view('books.book', compact('book','id','user'));
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

        $user = Auth::user();
        return redirect('/books')->with('success', 'The book has been deleted successfully!');
    }
    

    public function storeComment(Request $request, Book $book)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        //$comment->user_id = auth()->user()->id;
        $comment->user_id = Auth::id();
        $comment->book_id = $book->id;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('books.show', $book->id)
            ->with('success', 'Comment added successfully.');
    }

    public function action($bookId, $action)
    {
        //$user = auth()->user();
        $userBook = UserBook::where('user_id', /*$user->id*/ Auth::id())
            ->where('book_id', $bookId)
            ->first();
    
        if ($action == 'delete') {
            if ($userBook) {
                // Delete existing user_book record
                $userBook->delete();
            }
        } else {
            if ($userBook) {
                // Update existing user_book record
                if ($action == 1) {
                    $userBook->favorite = !$userBook->favorite;
                } elseif ($action == 2) {
                    $userBook->saved = !$userBook->saved;
                } elseif ($action == 3) {
                    $userBook->later = !$userBook->later;
                }
    
                $userBook->save();
            } else {
                // Create new user_book record
                $userBook = new UserBook();
                $userBook->user_id = /*$user->id*/ Auth::id();
                $userBook->book_id = $bookId;
    
                if ($action == 1) {
                    $userBook->favorite = true;
                } elseif ($action == 2) {
                    $userBook->save = true;
                } elseif ($action == 3) {
                    $userBook->read_later = true;
                }
    
                $userBook->save();
            }
        }
    
        return redirect()->back();
    }
    /*
    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        $books = Book::where('title', 'like', '%'.$query.'%')
            ->orWhereHas('user', function ($userQuery) use ($query) {
                $userQuery->where('name', 'like', '%'.$query.'%');
            })
            ->orWhere('language', 'like', '%'.$query.'%')
            ->get();
        
        return view('books.index', compact('books','user'));
    }
    */


    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        
        $books = Book::where('title', 'like', '%'.$query.'%')
            ->orWhereHas('user', function ($userQuery) use ($query) {
                $userQuery->where('name', 'like', '%'.$query.'%');
            })
            ->orWhere('language', 'like', '%'.$query.'%')
            ->get();
        
        return view('books.index', compact('books','user'));
    }

    
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
    
        // Update the book title and content
        $book->title = $request->input('title');
        $book->content = $request->input('content');
        $book->language = $request->input('language');
    
        // Check if a new cover photo is uploaded
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
    
            // Store the new cover photo in the storage folder
            $coverPath = $coverImage->store('public/images');
            $coverFileName = basename($coverPath);
    
            // Delete the previous cover photo if it exists
            if ($book->cover_image) {
                Storage::delete('public/images/' . $book->cover_image);
            }
    
            // Update the book's cover image
            $book->cover_image = $coverFileName;
        }
    
        // Save the updated book
        $book->save();
    
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function about()
    {
        return view('default.about');
    }
    
    public function delete_comment($id)
    {
        $book = Book::findOrFail($id);    

        $book->delete();

        $user = Auth::user();
        return redirect('/books')->with('success', 'The book has been deleted successfully!');
    }
}
