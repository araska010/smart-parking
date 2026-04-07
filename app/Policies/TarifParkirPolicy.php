<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TarifParkir;
use Illuminate\Auth\Access\HandlesAuthorization;

class TarifParkirPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TarifParkir');
    }

    public function view(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('View:TarifParkir');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TarifParkir');
    }

    public function update(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('Update:TarifParkir');
    }

    public function delete(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('Delete:TarifParkir');
    }

    public function restore(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('Restore:TarifParkir');
    }

    public function forceDelete(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('ForceDelete:TarifParkir');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TarifParkir');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TarifParkir');
    }

    public function replicate(AuthUser $authUser, TarifParkir $tarifParkir): bool
    {
        return $authUser->can('Replicate:TarifParkir');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TarifParkir');
    }

}