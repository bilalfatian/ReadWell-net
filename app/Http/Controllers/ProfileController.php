<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Book;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $all_books = Book::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'all_books' => $all_books,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    if ($request->hasFile('profile_picture')) {
        $profilePicture = $request->file('profile_picture');

        if ($profilePicture !== null) {
            $hashedName = Str::random(40) . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->storeAs('images/profile_picture', $hashedName, 'public');
        } else {
            // Set the hashed name to your default image file name
            $hashedName = 'default.png';
        }

        $request->user()->fill([
            'profile_picture' => $hashedName,
        ]);
    } elseif ($request->input('remove_image') === 'true') {
        $request->user()->fill([
            'profile_picture' => 'default.png',
        ]);
    }

    $request->user()->fill([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'email' => $request->input('email'),
    ]);

    $request->user()->save();

    return redirect()->route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
