<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //para el formulario de edición
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // actualiza la información del usuario
    public function update(ProfileUpdateRequest $request): RedirectResponse{
        $user = $request->user();

        $validated = $request->validated();

        // Si se cambia el email, se requiere reverificación
        if ($user->email !== $validated['email']) {
            $user->email_verified_at = null;
        }

        // Actualizar datos básicos
        $user->fill($validated);

        // Subir imagen de perfil (si se envía)
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    //borra la cuenta del usuario
    public function destroy(Request $request): RedirectResponse
    {
        //valida la contraseña para borrar la cuenta
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user(); //obtiene el usuario autenticado

        Auth::logout(); //cierra sesión

        $user->delete(); //elimina el usuario de la base de datos

        $request->session()->invalidate();
        $request->session()->regenerateToken(); //regenera el token CSRF

        return Redirect::to('/'); //redirecciona a la página de inicio
    }
}
