<div class="profile-sidebar mb-40">
    <div class="user-info-card text-center">
        <div class="user-avatar mb-20">
            <img src="{{ asset('assets/images/user/user-avatar.jpg') }}" alt="User Avatar">
            <div class="edit-avatar">
                <a href="#"><i class="far fa-edit"></i></a>
            </div>
        </div>
        <div class="user-content">
            <h3 class="user-name">{{ auth()->user()->name }}</h3>
            <p class="user-email">{{ auth()->user()->email }}</p>
        </div>
    </div>
    
    <div class="profile-menu-card mt-30">
        <ul class="profile-menu">
            {{-- <li class="active">
                <a href="#dashboard"><i class="fas fa-th-large"></i> Dashboard</a>
            </li> --}}
            <li>
                <a href="#profile-info"><i class="far fa-user-circle"></i> Profile Information</a>
            </li>
            <li>
                <a href="#change-password"><i class="far fa-lock"></i> Change Password</a>
            </li>
            {{-- <li>
                <a href="{{ route('cart') }}"><i class="far fa-shopping-cart"></i> My Cart</a>
            </li>
            <li>
                <a href="{{ route('user.orders') }}"><i class="far fa-shopping-bag"></i> My Orders</a>
            </li>
            <li>
                <a href="{{ route('wishlist') }}"><i class="far fa-heart"></i> My Wishlist</a>
            </li>
            <li>
                <form action="{{ route('user.logout') }}" method="POST" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="far fa-sign-out-alt"></i> Logout
                </a>
            </li> --}}
        </ul>
    </div>
</div>