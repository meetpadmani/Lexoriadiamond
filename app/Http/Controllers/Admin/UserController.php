<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WhatsAppService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('orders')->withSum('orders', 'total_amount')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,manager,staff,delivery_admin,user',
            'phone' => 'nullable|string|max:20',
        ]);

        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        $data['status'] = 'active';

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'New team member has been added successfully.');
    }

    public function show(User $user)
    {
        $user->load(['orders', 'addresses', 'reviews.product']);
        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->is_admin) {
            return back()->with('error', 'Administrator accounts cannot be blocked.');
        }

        $user->status = ($user->status === 'active') ? 'blocked' : 'active';
        $user->save();

        $message = $user->status === 'blocked' ? "Patron {$user->name} has been blocked." : "Patron {$user->name} has been unblocked.";
        return back()->with('success', $message);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Patron account has been removed successfully.');
    }

    public function sendResetLink(User $user)
    {
        $token = \Illuminate\Support\Str::random(64);

        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => \Illuminate\Support\Facades\Hash::make($token), 'created_at' => now()]
        );

        // This triggers the standard Laravel reset logic which will use the configured mailer
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($token, $user));

        if ($user->phone) {
            $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);
            $message = "*Lexoria Diamond Studio* 🔒\n\nA password reset was requested for your account by an administrator.\nClick here to securely reset it: {$resetLink}";
            app(WhatsAppService::class)->sendMessage($user->phone, $message);
        }

        return back()->with('success', "A royal reset mandate has been issued for {$user->name} and sent to their registered email and WhatsApp.");
    }
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:super_admin,manager,staff,delivery_admin,user'
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', "Role for {$user->name} has been updated to " . ucfirst(str_replace('_', ' ', $user->role)) . ".");
    }
}
