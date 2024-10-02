<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\SendAdminMessage;
 use App\Models\Blog;
use App\Models\Category;
use App\Models\Chat\SellerAdminChat;
use App\Models\Doctor\Doctor;
use App\Models\Seller\Seller;
 use App\Models\Admin;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactUs;
 use App\Models\Product\Product;

use App\Models\User;
use Illuminate\Support\Facades\Hash; 
class AdminController extends Controller
{
    public function updateBlog(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image
        ]);

        // Find the blog post by ID
        $blog = Blog::findOrFail($id);

        // Update the blog post data
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;

        // If a new image is uploaded, store it and delete the old one
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store the new image
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        // Save the changes
        $blog->save();

        // Redirect back with a success message
        return redirect()->route('admin.blog')->with('success', 'Blog updated successfully!');
    }
    public function destroyBlog($id)
    {
        // Find the blog by ID
        $blog = Blog::findOrFail($id);

        // Delete the image file if it exists
        
        // Delete the blog from the database
        $blog->delete();

        // Redirect back with a success message
        return redirect()->route('admin.blog')->with('success', 'Blog deleted successfully!');
    }

    public function storeBlog(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public'); // Store in 'storage/app/public/blogs'
        } else {
            $imagePath = null; // Default value if no image is provided
        }

        // Create the blog
        Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('category_id'),
            'image' => $imagePath, // Save image path
        ]);

        // Redirect back with success message
        return redirect()->route('admin.blog')->with('success', 'Blog created successfully!');
    }
 
     
       
        public function user(Request $request)
        {
             $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
            if (!$LoggedAdminInfo) {
                return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
            }
    
             $users = User::paginate(5);
    
             return view('admin.user', ['users' => $users, 'LoggedAdminInfo' => $LoggedAdminInfo]);
        }
       
        public function blog(Request $request)
        {
             $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
            if (!$LoggedAdminInfo) {
                return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
            }
            $categories = Category::all();
    
            $blogs = Blog::paginate(5);
    
             return view('admin.blog', ['blogs' => $blogs,'categories'=>$categories, 'LoggedAdminInfo' => $LoggedAdminInfo]);
        }
        
    
    
    public function destroy($id)
    {
        $seller = Seller::find($id);
    
        if (!$seller) {
            return redirect()->route('admin.seller')->with('fail', 'Seller not found.');
        }
    
        // Delete the seller
        $seller->delete();
    
        return redirect()->route('admin.seller')->with('success', 'Seller deleted successfully.');
    }
        function login()
        {
            return view('admin.login');
        }
        function category()
        {
            $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
        
            if (!$LoggedAdminInfo) {
               return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
           }
           $categories = Category::paginate(6);
    
           return view('admin.category', [
            'LoggedAdminInfo' => $LoggedAdminInfo,            'categories' => $categories 
        ]);
            }
             
            
            public function addCategory(Request $request)
            {
                // Validate the request data
                $request->validate([
                    'name' => 'required|unique:categories|max:255',
                ]);
        
                // Create a new category
                Category::create([
                    'name' => $request->input('name'),
                ]);
        
                // Redirect or return response
                return redirect()->route('admin.category')->with('success', 'Category added successfully!');
            }
        
            // Method to delete a category
            public function deleteCategory($id)
            {
                // Find the category by ID
                $category = Category::findOrFail($id);
        
                // Delete the category
                $category->delete();
        
                // Redirect back or return response
                return redirect()->route('admin.category')->with('success', 'Category deleted successfully!');
            }
        
            // Method to update a category
            public function updateCategory(Request $request, $id)
            {
                // Validate the request data
                $request->validate([
                    'name' => 'required|string|max:255',
                ]);
        
                // Find the category by ID
                $category = Category::findOrFail($id);
        
                // Update category name
                $category->name = $request->input('name');
        
                // Save the updated category
                $category->save();
        
                // Redirect back with a success message
                return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
            }
        function register()
        {
            return view('admin.register');
        }
    
    
    
    
    
    
    
        public function check(Request $request)
        {
             $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:5|max:12'
            ]);
        
            $adminInfo = Admin::where('email', $request->email)->first();
        
            if (!$adminInfo) {
                return back()->withInput()->withErrors(['email' => 'Email not found']);
            }
        
            if (!Hash::check($request->password, $adminInfo->password)) {
                return back()->withInput()->withErrors(['password' => 'Incorrect password']);
            }
        
             session(['LoggedAdminInfo' => $adminInfo->id]);
        
            return redirect()->route('admin.dashboard');
        }
        
    
        public function logout()
        {
             if (session()->has('LoggedAdminInfo')) {
                 session()->forget('LoggedAdminInfo');
            }
             return redirect()->route('admin.login');
        }
        
    
    
        public function dashboard()
        {
            $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
        
            if (!$LoggedAdminInfo) {
                return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
            }
        
            $recentUsers = User::orderBy('created_at', 'desc')->distinct()->limit(5)->get();
             $totalblogsCount = Blog::count();   
            $totalUserCount = User::count();
           
              $recentBlogs = Blog::orderBy('created_at', 'desc')->limit(5)->get();
        
            return view('admin.dashboard', [
                'LoggedAdminInfo' => $LoggedAdminInfo,
                
     
                'totalUserCount' => $totalUserCount,
                'recentUsers' => $recentUsers,
                 'totalblogsCount' => $totalblogsCount,
                 'recentBlogs' => $recentBlogs,
            ]);
        }
        
       
    
    
        
       
        
     
      
        
    
     
   
    
  
   
        public function profile()
        {
            
            $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
            if (!$LoggedAdminInfo) {
                return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
            }
        
             return view('admin.profile', ['LoggedAdminInfo' => $LoggedAdminInfo]);
        }
     
        public function updateProfile(Request $request)
        {
             $loggedAdmin = Admin::find(session('LoggedAdminInfo'));
            
             if (!$loggedAdmin) {
                return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
            }
            
             $request->validate([
                'name' => 'nullable|string|max:255',
                'username' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone_number' => 'nullable|string|max:20',
            ]);
            
             $loggedAdmin->name = $request->input('name');
            $loggedAdmin->username = $request->input('username');
            $loggedAdmin->bio = $request->input('bio');
            $loggedAdmin->phone_number = $request->input('phone_number');
        
             if ($request->hasFile('picture')) {
                 $pictureFile = $request->file('picture');
                
                 $picturePath = $pictureFile->store('public/downloads');
                
                 $loggedAdmin->picture = str_replace('public/', '', $picturePath);
            }
            
             $loggedAdmin->save();
            
             return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        }
        
        
        
        
        public function delete($id)
        {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }
        
            $user->delete();
        
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
         public function update(Request $request, $id)
        { 
             $request->validate([
                'username' => 'nullable|string|max:255',
                'email' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:20',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
             $user = User::findOrFail($id);
        
             $user->username = $request->input('username');
            $user->phone_number = $request->input('phone_number');
            $user->email = $request->input('email');
        
             if ($request->hasFile('picture')) {
                 $pictureFile = $request->file('picture');
                
                 $picturePath = $pictureFile->store('public/downloads');
                
                 $picturePath = str_replace('public/', '', $picturePath);
        
                 $user->picture = $picturePath;
            }
        
             $user->save();
        
             return redirect()->route('admin.user')->with('success', 'User profile updated successfully');
        }
        
        public function activate($id)
            {
                $user = User::findOrFail($id);
                $user->status = 'active';
                $user->save();
        
                return redirect()->back()->with('success', 'User activated successfully.');
            }
        
            public function deactivate($id)
            {
                $user = User::findOrFail($id);
                $user->status = 'inactive';
                $user->save();
        
                return redirect()->back()->with('success', 'User deactivated successfully.');
            }
    
    }
    
 