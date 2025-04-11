<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Category;
class BlogController extends Controller
{
    public function getBlogsAndCategories(Request $request)
    {
        // Fetch all categories
        $categories = Category::all();
    
        // Fetch all blogs with optional filters and eager load relationships
        $query = Blog::with(['category', 'comments.user']); // Eager load comments and their users
    
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->has('blog_title') && !empty($request->blog_title)) {
            $query->where('title', 'like', '%' . $request->blog_title . '%');
        }
    
        $blogs = $query->orderBy('created_at', 'desc')->get();
        
        // Transform blogs to include comments count and user information
        $blogs = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $blog->content,
                'category' => $blog->category,
                'image' => $blog->image,
                'created_at' => $blog->created_at,
                'comments_count' => $blog->comments->count(),
                'comments' => $blog->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'comment' => $comment->comment,
                        'created_at' => $comment->created_at,
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'email' => $comment->user->email,
                            'image' => $comment->user->image,
                        ]
                    ];
                })
            ];
        });
    
        return response()->json([
            'success' => true,
            'categories' => $categories,
            'blogs' => $blogs
        ]);
    }

    public function getBlogDetail($id)
    {
        try {
            // Fetch blog with all related data using eager loading
            $blog = Blog::with([
                'category',
                'comments.user',
                'admin' // Include admin information who created the blog
            ])->findOrFail($id);

            // Clean the content by removing HTML tags and special characters
            $cleanContent = strip_tags($blog->content);
            $cleanContent = str_replace(["\r\n", "\r", "\n", "\t"], ' ', $cleanContent);
            $cleanContent = preg_replace('/\s+/', ' ', $cleanContent); // Replace multiple spaces with single space
            $cleanContent = trim($cleanContent); // Remove leading and trailing whitespace

            // Transform the blog data
            $blogDetail = [
                'id' => $blog->id,
                'title' => $blog->title,
                'content' => $cleanContent,
                'image' => $blog->image,
                'created_at' => $blog->created_at,
                'updated_at' => $blog->updated_at,
                'category' => $blog->category,
                'author' => [
                    'id' => $blog->admin->id,
                    'name' => $blog->admin->name,
                    'email' => $blog->admin->email,
                ],
                'comments_count' => $blog->comments->count(),
                'comments' => $blog->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'comment' => $comment->comment,
                        'created_at' => $comment->created_at,
                        'user' => [
                            'id' => $comment->user->id,
                            'name' => $comment->user->name,
                            'email' => $comment->user->email,
                            'image' => $comment->user->image,
                        ]
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'blog' => $blogDetail
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Blog not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function storeComment(Request $request, $blog_id)
    {
        try {
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['success' => false, 'error' => 'Token not provided'], 401);
            }
            $token = str_replace('Bearer ', '', $token);
            
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return response()->json(['success' => false, 'error' => 'User not found'], 404);
            }

            // Validate request
            $request->validate([
                'comment' => 'required|string|max:1000',
            ]);

            // Create comment
            $comment = Comment::create([
                'blog_id' => $blog_id,
                'user_id' => $user->id,
                'comment' => $request->comment,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully!',
                'comment' => $comment
            ], 201);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['success' => false, 'error' => 'Token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['success' => false, 'error' => 'Invalid token'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Token error: ' . $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong!',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
}
