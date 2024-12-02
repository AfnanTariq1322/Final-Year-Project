<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class BlogController extends Controller
{
    public function storeComment(Request $request, $blog_id)
    {
        // Validate incoming request
        $request->validate([
            'comment' => 'required|string|max:1000', // Add more validation if necessary
        ]);

        // Get the user from session (assuming the user is logged in)
        $userId = session('LoggedUserInfo');
        $LoggedUserInfo = User::find($userId);

        // If the user is not logged in, redirect them to the login page
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to post a comment.');
        }

        // Create the comment
        Comment::create([
            'blog_id' => $blog_id,
            'user_id' => $userId,
            'comment' => $request->comment,
        ]);

        // Redirect back to the blog page with a success message
        return redirect()->route('blogdetail', $blog_id)->with('success', 'Comment added successfully!');
    }
}
