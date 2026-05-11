<?php

use App\Mail\OrderInvoiceMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

beforeEach(function () {
    view()->share('siteSettings', new Setting());
});

function makeProductWithStock(int $stock = 10): Product
{
    $category = Category::create([
        'name' => 'Checkout Category',
    ]);

    $subcategory = Subcategory::create([
        'name' => 'Checkout Subcategory',
        'category_id' => $category->id,
    ]);

    return Product::create([
        'name' => 'Checkout Product',
        'product_code' => 'CHK-' . str()->upper(str()->random(8)),
        'regular_price' => 50,
        'discount_price' => null,
        'stock_quantity' => $stock,
        'category_id' => $category->id,
        'subcategory_id' => $subcategory->id,
    ]);
}

function validOrderPayload(User $user): array
{
    return [
        'name' => $user->name,
        'phone' => '01712345678',
        'email' => $user->email,
        'country' => 'Bangladesh',
        'city' => 'Dhaka',
        'postcode' => '1207',
        'street_address' => 'House 1, Road 2',
        'payment_method' => 'Cash On Delivery',
        'order_notes' => 'Please call before delivery',
    ];
}

it('blocks admin role from checkout and order placement routes', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(route('checkout'))
        ->assertForbidden();

    $this->actingAs($admin)
        ->post(route('order.place'), validOrderPayload($admin))
        ->assertForbidden();
});

it('prevents users from viewing another users order success page', function () {
    $owner = User::factory()->create(['role' => 'user']);
    $otherUser = User::factory()->create(['role' => 'user']);

    $order = Order::create([
        'user_id' => $owner->id,
        'order_number' => '#TEST-ORDER-001',
        'subtotal' => 100,
        'shipping_cost' => 0,
        'tax' => 0,
        'total_amount' => 100,
        'payment_method' => 'Cash On Delivery',
        'payment_status' => 'Pending',
        'order_status' => 'Pending',
        'country' => 'Bangladesh',
        'city' => 'Dhaka',
        'postcode' => '1207',
        'street_address' => 'Address',
        'phone' => '01712345678',
        'email' => 'owner@example.com',
    ]);

    $this->actingAs($otherUser)
        ->get(route('order.success', ['order' => $order->id]))
        ->assertForbidden();
});

it('places order successfully and clears cart with stock update', function () {
    Mail::fake();

    $user = User::factory()->create(['role' => 'user']);
    $product = makeProductWithStock(10);

    Cart::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => 50,
        'total_price' => 100,
    ]);

    $response = $this->actingAs($user)
        ->post(route('order.place'), validOrderPayload($user));

    $order = Order::first();

    $response->assertRedirect(route('order.success', ['order' => $order->id]));
    expect($order)->not->toBeNull();

    expect(OrderItem::where('order_id', $order->id)->count())->toBe(1);
    expect(OrderTracking::where('order_id', $order->id)->count())->toBe(1);
    expect(Cart::where('user_id', $user->id)->count())->toBe(0);
    expect($product->fresh()->stock_quantity)->toBe(8);

    Mail::assertSent(OrderInvoiceMail::class, 1);
});

it('redirects checkout when cart is empty and does not create order', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)
        ->get(route('checkout'))
        ->assertRedirect(route('cart'))
        ->assertSessionHas('error');

    $this->from(route('cart'))
        ->actingAs($user)
        ->post(route('order.place'), validOrderPayload($user))
        ->assertRedirect(route('cart'))
        ->assertSessionHas('error');

    expect(Order::count())->toBe(0);
});

