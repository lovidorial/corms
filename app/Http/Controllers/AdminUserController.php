<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function __construct()
    {
        // ensure admin middleware applied on route group, but can also double-check here
        $this->middleware(\App\Http\Middleware\AdminMiddlerware::class);
    }

    /**
     * Display a listing of the users (excluding current admin).
     */
    public function index(Request $request): View
    {
        $users = User::where('id', '!=', $request->user()->id)
                     ->orderBy('name')
                     ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['profile_photo_path'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->fill($data);

        if (array_key_exists('email', $data) && $user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user, Request $request): RedirectResponse
    {
        // prevent deleting yourself just in case
        if ($user->id === $request->user()->id) {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete yourself.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
