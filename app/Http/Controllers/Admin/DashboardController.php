<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function index(): View {
        return view('admin.dashboard');
    }

    public function settings(): View {
        return view('admin.settings');
    }

    public function avatarChange(Request $request): RedirectResponse {
        
        $request->validate([
            'avatar' => ['required', 'file', 'mimes:jpg,jpeg,webp,png', 'max: 1500']
        ]);
        
        if ($request->hasFile('avatar')) {
            $imgPath = $request->file('avatar')->store('profile', 'public');
            $request->user()->image = $imgPath;
            $request->user()->save();

            notyf()->success(__('admin.avatar_change_success'));
        }

        return redirect()->route('admin.settings');
    }

    public function avatarDestroy(Request $request): RedirectResponse {

        $request->user()->image = '';
        $request->user()->save();

        return redirect()->route('admin.settings');
    }

    public function nameChange(Request $request): RedirectResponse {

        $request->validate([
            'name' => ['required', 'string', 'max: 80']
        ]);

        $request->user()->name = $request->name;
        $request->user()->save();

        notyf()->success(__('admin.name_change_success'));

        return redirect()->route('admin.settings');
    }

    public function updatePassword(Request $request): RedirectResponse {

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->password = bcrypt($request->new_password);
        $request->user()->save();

        notyf()->success(__('admin.password_update_success'));

        return redirect()->route('admin.settings');
    }

    public function updateLanguage(Request $request): RedirectResponse {

        $request->validate([
            'language' => ['required', 'in:tr,en,de'],
        ]);

        if ($request->user()->language !== $request->language) {
            $request->user()->language = $request->language;
            $request->user()->save();

            session(['admin_locale' => $request->language]);
            app()->setLocale($request->language);
            
            notyf()->success(__('admin.language_change_success'));
        }

        return redirect()->route('admin.settings');
    }
}
