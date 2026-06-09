<?php

namespace App\Policies;

use App\Models\KasOrganisasi;
use App\Models\User;

class KasOrganisasiPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return in_array($user->role, ['super_admin', 'bendahara'], true);
    }

    public function delete(User $user, KasOrganisasi $kasOrganisasi): bool
    {
        return in_array($user->role, ['super_admin', 'bendahara'], true);
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
