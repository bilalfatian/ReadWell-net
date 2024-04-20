<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function checkAuthorization($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            return redirect()->route('user.profile')->with('error', 'Vous n\'êtes pas autorisé à modifier ce compte.');
        }
    }

    /*
    public function index()
    {
        $user = User::all();
        $currentUser = auth()->user();
        $books = Book::all();
        return view('default._navbar', compact('user', 'currentUser', 'books'));
    }
    */


    public function index()
    {
        //$currentUser = auth()->user();

        $current_user_id = Auth::id();


        $all_users = User::where('user_role', '!=', 'admin')
                ->whereHas('books', function ($query) {
                    $query->where('approved', 1)
                        ->where('hidden', 1);
                })
                 ->where('id', '!=', $current_user_id)
                 ->get();
        return view('users.index', compact('all_users'));
    }
   

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Create the user
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->user_role = "amateur"; //the default type of the new users
        $user->description = $request->input('description');
        $user->remember_token = Str::random(10);

        if ($request->hasFile('profile_picture')) {
            $photo = $request->file('profile_picture');
            $photo->store('public/images/profile_picture');
            $user->profile_picture = $photo->hashName();
        } else {
            $user->profile_picture = 'default.png'; // Set default photo name
        }
        
        $user->save();
        return redirect('/login')->with('success', 'The user has been created successfully!');
    }

    public function showLoginForm()
    {
        return view('users.login');
    }
    /*
    public function login(Request $request)
    {
        //$user = User::all();
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('books.index');
        } else {
            // Authentication failed, redirect back to the login form with an error message
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }*/

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.books.index');
        } else {
            return redirect()->route('books.index');
        }
    } else {
        // Authentication failed, redirect back to the login form with an error message
        return redirect()->back()->with('error', 'Invalid email or password.');
    }
}


    public function showProfile(User $user)
    {
        return view('users.profile', compact('user'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== Auth::id()) {
            return redirect()->route('user.profile',Auth::id())->with('error', 'Vous n\'êtes pas autorisé à modifier ce compte.');
        }
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'description' => 'nullable|string',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->description = $validatedData['description'];
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // Vérifier si l'utilisateur connecté est autorisé à supprimer le compte
        if ($user->id !== Auth::id()) {
            return redirect()->route('user.profile')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce compte.');
        }

        if ($user) {
            $user->delete();
            return redirect()->route('user.login')->with('success', 'Utilisateur supprimé avec succès.');
        }
        return redirect()->back()->with('error', 'Utilisateur non trouvé.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.login')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function showPasswordChangeForm()
    {
        $user = Auth::user();
        return view('users.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Vérifier si le mot de passe actuel correspond à celui de l'utilisateur
        if (Hash::check($request->current_password, $user->password)) {
            // Mettre à jour le mot de passe de l'utilisateur
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Votre mot de passe a été modifié avec succès.');
        } else {
            return redirect()->back()->with('error', 'Le mot de passe actuel est incorrect.');
        }
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id == Auth::id()){
            $comment->delete();
            return redirect()->back()->with('success', 'Comment has been deleted.');
        }
        else {
            return redirect()->back()->with('error', 'permission denied');
        }
        

        
    }


    public function updateCheckbox(Request $request, $id)
    {
        $isChecked = $request->input('isChecked');
        $book = Book::findOrFail($id);

        if ($isChecked && $book->hidden == 0) {
            $book->hidden = 1;
        } else {
            $book->hidden = 0;
        }
        $book->save();
        return redirect('/login');
    }

}
