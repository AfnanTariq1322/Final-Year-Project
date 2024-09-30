<header id="active-sticky" class="inflanar-header">
    <div class="inflanar-header__middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="inflanar-header__inside">
                        <div class="inflanar-header__group">
                            <div class="inflanar-header__logo">
                                <a href="https://createrdirect.corammerswork.com/"><img
                                        src="../img/newicon.png" alt="#"></a>    <span    style="color:#604BB0 !importantfont-size: 18px; vertical-align: middle; margin-left: 4px;">Retina Fundus Analysis</span>

                            </div>
                            <div class="inflanar-header__menu">
                                <div class="navbar">
                                    <div class="nav-item">
                                        <ul class="nav-menu menu navigation list-none">
                                            <li class="active"><a
                                                    href="/home">Home</a>
                                            </li>
                                            <li><a href="/about">About</a></li>
                                            <li><a href="/blogs">Our Blogs</a></li>
                                            <li><a href="">Diseases</a></li>
                                            <li><a href="">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="offcanvas-toggler" data-bs-toggle="modal"
                            data-bs-target="#offcanvas-modal"><span class="line"></span><span
                                class="line"></span><span class="line"></span>
                        </button>
                        <div class="inflanar-header__button">
                        <div class="inflanar-header__button">
                            @if(session('LoggedUserInfo'))
                                <span class="user-name">Welcome, {{ session('LoggedUserName') }}</span>
                                <a href="{{ route('user.dashboard') }}" class="inflanar-btn inflanar-btn--header">Dashboard</a>
                             @else
                                <a href="/user/login" class="inflanar-btn1 inflanar-btn__nbg">Login</a>
                                <a href="/user/register" class="inflanar-btn inflanar-btn--header"><span>Sign Up</span></a>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
