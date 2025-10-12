<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Actions\Fortify\UpdateUserProfileInformation;

class AdditionalProfileFields extends Component
{
    /**
     * The component's state.
     */
    public $state = [];

    /**
     * Prepare the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->state = [
            'rfc' => $user->rfc,
            'curp' => $user->curp,
            'sexo' => $user->sexo,
            'puesto' => $user->puesto,
        ];
    }

    /**
     * Update the user's additional profile information.
     */
    public function updateAdditionalInformation(): void
    {
        $this->resetErrorBag();

        $updater = new UpdateUserProfileInformation();
        $updater->update(Auth::user(), $this->state);

        $this->emit('saved');
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.additional-profile-fields');
    }
}
