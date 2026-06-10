<?php

namespace App\Policies;

use App\Models\KasOrganisasi;
use App\Models\User;

class KasOrganisasiPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'bendahara', 'anggota'], true);
    }

    public function view(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        if ($user->role === 'super_admin') {
            return true;
        }

        if ($kasOrganisasi->created_by === $user->id) {
            return true;
        }

        return $kasOrganisasi->anggota()->where('user_id', $user->id)->where('status', 'accepted')->exists();
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'bendahara'], true);
    }

    public function update(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return $user->role === 'super_admin'
            || ($user->role === 'bendahara' && $kasOrganisasi->created_by === $user->id);
    }

    public function delete(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return $user->role === 'super_admin'
            || ($user->role === 'bendahara' && $kasOrganisasi->created_by === $user->id);
    }

    public function join(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return $user->role === 'anggota';
    }

    public function manageMembership(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return in_array($user->role, ['super_admin', 'bendahara'], true);
    }
}
