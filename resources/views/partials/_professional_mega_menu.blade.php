<div class="pro-menu-sidebar">
    <ul class="pro-menu-list">
        @foreach ($categories->take(8) as $category)
            <li class="pro-menu-item @if($category->subcategories->count() > 0) has-mega @endif">
                <a href="{{ route('shops', ['category' => $category->id]) }}" class="pro-menu-link">
                    <span class="cat-icon"><i class="fas fa-shopping-basket"></i></span> <span class="cat-name">{{ $category->name }}</span>
                    @if($category->subcategories->count() > 0)
                        <span class="arrow-icon"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </a>

                @if ($category->subcategories->count() > 0)
                    <div class="mega-menu-panel">
                        <div class="mega-panel-content">
                            @foreach ($category->subcategories as $sub)
                            <div class="mega-column">
                                <a href="{{ route('shops', ['subcategory' => $sub->id]) }}" class="mega-heading">
                                    {{ $sub->name }}
                                </a>
                                {{-- 
                                <ul class="mega-child-list">
                                    <li><a href="#">Child Item 1</a></li>
                                    <li><a href="#">Child Item 2</a></li>
                                </ul> 
                                --}}
                            </div>
                            @endforeach
                        </div>
                         {{-- <div class="mega-banner">
                            <img src="{{ asset('assets/images/promo-banner.jpg') }}" alt="Promo">
                        </div> --}}
                    </div>
                @endif
            </li>
        @endforeach

        <li class="pro-menu-item view-all-btn">
            <a href="{{ route('shops') }}" class="pro-menu-link">
                <span class="cat-icon"><i class="fas fa-th-large"></i></span>
                <span class="cat-name">View All Categories</span>
            </a>
        </li>
    </ul>
</div>