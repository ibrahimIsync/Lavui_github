<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;


class WishlistTableSeeder extends Seeder
{
    public array $wishlists = [
        [
            'user'    => 1,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 2,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 3,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 4,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 5,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 6,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 7,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 8,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
        [
            'user'    => 9,
            'product' => [1, 2, 3, 4, 5, 9],
        ],
    ];

    public function run()
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO') && $envService->getValue('DISPLAY') == 'fashion') {
            foreach ($this->wishlists as $wishlist) {
                foreach ($wishlist['product'] as $product) {
                    Wishlist::create([
                        'user_id'    => $wishlist['user'],
                        'product_id' => $product,
                    ]);
                }
            }
        }
    }
}
