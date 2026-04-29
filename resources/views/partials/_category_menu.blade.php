<ul class="pro-category-list">
    @foreach ($categories->take(7) as $category)
        <li class="pro-category-item">
            <div class="pro-category-header">
                <a href="{{ route('shops', ['category' => $category->id]) }}" class="pro-category-link">
                    {{ $category->name }}
                </a>
                
                @if ($category->subcategories->count() > 0)
                    <span class="pro-sub-toggle">
                        <i class="fas fa-chevron-down"></i>
                    </span>
                @endif
            </div>

            @if ($category->subcategories->count() > 0)
                <ul class="pro-subcategory-list">
                    @foreach ($category->subcategories as $sub)
                        <li>
                            <a href="{{ route('shops', ['subcategory' => $sub->id]) }}" class="pro-subcategory-link">
                                {{ $sub->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach

    @if ($categories->count() > 7)
        <li class="pro-category-item view-all-item">
            <a href="{{ route('shops') }}" class="pro-category-link text-success fw-bold">
                View All Categories <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </li>
    @endif
</ul>