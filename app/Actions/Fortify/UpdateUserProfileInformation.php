<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'rfc' => ['nullable', 'string', 'max:14', 'min:10'],
            'curp' => ['nullable', 'string', 'max:19', 'min:10'],
            'sexo' => ['nullable', 'in:femenino,masculino'],
            'puesto' => ['nullable', 'string', 'in:Director,Subdirector,Coordinador,Jefe de departamento,Analista Especializado,Analista'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'rfc' => $input['rfc'] ?? null,
                'curp' => $input['curp'] ?? null,
                'sexo' => $input['sexo'] ?? null,
                'puesto' => $input['puesto'] ?? null,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
            'rfc' => $input['rfc'] ?? null,
            'curp' => $input['curp'] ?? null,
            'sexo' => $input['sexo'] ?? null,
            'puesto' => $input['puesto'] ?? null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
