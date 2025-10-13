<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Actions\Fortify\UpdateUserProfileInformation;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     */
    public $state = [];

    /**
     * The new avatar for the user.
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     */
    public $verificationLinkSent = false;

    /**
     * Prepare the component.
     */
    public function mount(): void
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfileInformation(UpdateUserProfileInformation $updater): void
    {
        $this->resetErrorBag();

        // Si hay una nueva foto, procesarla
        if ($this->photo) {
            $this->validate([
                'photo' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            ]);

            // Eliminar foto anterior si existe
            $user = Auth::user();
            if ($user->profile_photo_path) {
                if (Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                } elseif (file_exists(public_path($user->profile_photo_path))) {
                    unlink(public_path($user->profile_photo_path));
                }
            }

            // Guardar nueva foto
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $this->photo->getClientOriginalExtension();
            $path = $this->photo->storeAs('profile-photos', $filename, 'public');
            
            // Actualizar el estado con la nueva ruta de foto
            $this->state['profile_photo_path'] = 'profile-photos/' . $filename;
        }

        $updater->update(Auth::user(), $this->state);

        if (isset($this->photo)) {
            $this->emit('saved');
            $this->emit('refresh-navigation-menu');
            $this->emit('photo-updated');
            return redirect()->route('profile.show');
        }

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }

    /**
     * Delete user's profile photo.
     */
    public function deleteProfilePhoto(): void
    {
        $user = Auth::user();
        
        // Eliminar archivo físico si existe
        if ($user->profile_photo_path) {
            if (Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            } elseif (file_exists(public_path($user->profile_photo_path))) {
                unlink(public_path($user->profile_photo_path));
            }
        }

        // Actualizar en base de datos
        $user->update(['profile_photo_path' => null]);
        
        // Actualizar el estado
        $this->state['profile_photo_path'] = null;

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Send an email verification notification to the user.
     */
    public function sendEmailVerification(): void
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}