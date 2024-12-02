	<!--**********************************
            Sidebar start
        ***********************************-->
	<div class="deznav">
	    <div class="deznav-scroll mm-active ps ps--active-y">
	        <div class="main-profile">
	            <div class="image-bx">
	                @if($LoggedAdminInfo['picture'])
	                <img src="{{ asset('storage/' . $LoggedAdminInfo['picture']) }}" alt="Profile Picture" width="100"
	                    height="100">
	                @else
	                <img src="{{ asset('path_to_default_image.jpg') }}" alt="Default Picture" width="100" height="100">
	                @endif
	                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
	            </div>
	            <h5 class="name"><span class="font-w400">Hello,</span> {{ $LoggedAdminInfo['name'] }}</h5>
	        </div>
	        <ul class="metismenu mm-show" id="menu">
	            <li><a href="/admin/dashboard" aria-expanded="false">
	                    <i class="flaticon-144-layout"></i>
	                    <span class="nav-text">Dashboard</span>
	                </a>


	            </li>
				<li>
    <a href="/admin/profile" aria-expanded="false">
        <i class="flaticon-381-user"></i> <!-- Flaticon for Profile -->
        <span class="nav-text">Profile</span>
    </a>
</li>
<li>
    <a href="/admin/blog" aria-expanded="false">
        <i class="flaticon-381-list"></i> <!-- Flaticon for Blogs -->
        <span class="nav-text">Blogs</span>
    </a>
</li>
 
<li>
    <a href="/admin/user" aria-expanded="false">
        <i class="flaticon-381-user-1"></i> <!-- Flaticon for Users -->
        <span class="nav-text">Users</span>
    </a>
</li>
 

 
<li>
    <a href="/admin/category" aria-expanded="false">
        <i class="flaticon-381-folder"></i> <!-- Flaticon for Category -->
        <span class="nav-text">Category</span>
    </a>
</li>

 

<li>
    <a href="/admin/contact" aria-expanded="false">
        <i class="fa fa-address-book"></i> <!-- FontAwesome icon for Contacts -->
        <span class="nav-text">Messeges/Contacts</span>
    </a>
</li>

	        </ul>
	       
	    </div>
	</div>
	<!--**********************************
            Sidebar end
        ***********************************-->