<?php

namespace App\Service\User;

use Exception;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function getAllBlog(array $dataSearch = []): LengthAwarePaginator
    {
        $query = Post::where('user_id', Auth::id());
        if ($dataSearch['data']) {
            $query->where('title', 'like', '%' . $dataSearch['data'] . '%');
        }
        if ($dataSearch['categoryId']) {
            $query->where(['category_id' => $dataSearch['categoryId']]);
        }

        return $query->with('user')
            ->orderBy('id')
            ->paginate(Post::LIMIT_BLOG_PAGE)
            ->withQueryString($dataSearch);
    }

    public function updatePassword(object $data): int|string
    {
        try {
            $user = User::find(Auth::id());
            if (Hash::check($data->password, $user->password)) {
                return __('auth.password_not_duplicate');
            }
            if (Hash::check($data->password_current, $user->password)) {
                $user->update([
                    'password' => Hash::make($data->password)
                ]);

                return 200;
            }

            return __('auth.incorrect_password');
        } catch (Exception $e) {
            return __('auth.try_again');
        }
    }

    public function updateUser(object $data, object $user): bool
    {
        try {
            if (isset($data['avatar'])) {
                $fileName = Storage::disk('public')->put('images', $data->file('avatar'));
            } else {
                $fileName = $user->avatar;
            }
            $user->update([
                'user_name' => $data['user_name'],
                'avatar' => $fileName,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
