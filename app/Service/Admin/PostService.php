<?php

namespace App\Service\Admin;

use Exception;
use App\Models\User;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    public function getAllBlog(int $status): LengthAwarePaginator
    {
        if ($status === Post::STATUS_ALL_BLOG) {
            return Post::with('likes')->paginate(Post::LIMIT_BLOG_PAGE);
        }

        return Post::notApproved()->with('likes')->paginate(Post::LIMIT_BLOG_PAGE);
    }

    public function searchBlog(array $dataSearch, int $status): LengthAwarePaginator
    {
        $query = Post::where('title', 'like', '%' . $dataSearch['data'] . '%')
            ->orWhere('content', 'like', '%' . $dataSearch['data'] . '%');
        if ($status === Post::STATUS_NOT_APPROVED) {
            $query->notApproved();
        }

        return $query->paginate(Post::LIMIT_BLOG_PAGE)
            ->withQueryString($dataSearch);
    }

    public function getTotalRecord(): array
    {
        $totalUser = User::count();
        $totalUserInActive = User::where('status', User::STATUS_INACTIVE)->count();
        $totalBlog = Post::count();
        $totalBlogNotApproved = Post::notApproved()->count();

        return [
            'totalUser' => $totalUser,
            'totalUserInActive' => $totalUserInActive,
            'totalBlog' => $totalBlog,
            'totalBlogNotApproved' => $totalBlogNotApproved,
        ];
    }

    public function approvedBlog(Post $blog): bool
    {
        try {
            $blog->update([
                'status' => !$blog->status
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function approvedAllBlog(): bool
    {
        try {
            Post::notApproved()->update([
                'status' => Post::STATUS_APPROVED
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
