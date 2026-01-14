<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - DCodeMania')]
class ProductDetailPage extends Component {
    public $slug;
    public $quantity = 1;

    public function mount($slug) {
        $this->slug = $slug;
    }

    public function increaseQuantity() {
        $this->quantity++;
    }

    public function decreaseQuantity() {
        if($this->quantity > 1) $this->quantity--;
    }

    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Success to add a product to cart!',
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true
        ]);
    }

    public function render() {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail()
        ]);
    }
}