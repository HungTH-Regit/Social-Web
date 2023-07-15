<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Service\User\PostService;
use App\Service\User\CommentService;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected CommentService $commentService;

    protected PostService $postService;

    public function __construct(CommentService $commentService, PostService $postService)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
    }

    public function store(CommentRequest $request, Post $blog)
    {
        $this->authorize('create', Comment::class);
        if ($this->commentService->create($request, $blog)) {
            $comments = $this->commentService->getAll($blog->id);
            $tableView = view('layouts.components.item_comment', ['comments' => $comments])->render();

            return response()->json([
                'success' => true,
                'tableView' => $tableView,
            ]);
        }
    }

    public function viewMore(Request $request)
    {
        $comments = $this->commentService->getAll($request->id);
        $tableView = view('layouts.components.item_comment', ['comments' => $comments])->render();

        return response()->json([
            'success' => true,
            'tableView' => $tableView,
        ]);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        if ($this->commentService->update($request, $comment)) {
            return redirect()->back()->with('success', __('comment.notify_update_success'));
        }

        return redirect()->back()->with('error', __('comment.notify_update_error'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        if ($this->commentService->delete($comment)) {
            return redirect()->back()->with('success', __('comment.notify_delete_success'));
        }

        return redirect()->back()->with('error', __('comment.notify_delete_error'));
    }
}
