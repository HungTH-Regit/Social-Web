<?php

namespace App\Service\Admin;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getAllUser(): LengthAwarePaginator
    {
        return User::paginate(User::LIMIT_USER_PAGE);
    }

    public function delete(object $user): bool
    {
        try {
            if (Auth::id() === $user->id) {
                return false;
            }
            DB::beginTransaction();
            $user->likes()->detach();
            $user->comments()->delete();
            $user->blogs()->delete();
            $user->delete();
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
