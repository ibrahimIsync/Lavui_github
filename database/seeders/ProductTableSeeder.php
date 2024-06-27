<?php

namespace Database\Seeders;

use App\Enums\Activity;
use App\Enums\Ask;
use App\Enums\ShippingType;
use App\Enums\Status;
use App\Models\Product;
use App\Models\ProductSeo;
use App\Models\ProductTag;
use App\Models\ProductTax;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductTableSeeder extends Seeder
{

    public function run(): void
    {
        $fashionProducts = [
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 1',
                        'ar' => 'المنتج الاول'
                    ],
                    'category'         => 1,
                    'brand'            => 1,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 2',
                        'ar' => 'المنتج الثاني'
                    ],
                    'category'         => 1,
                    'brand'            => 1,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 3',
                        'ar' => 'المنتج الثالث'
                    ],
                    'category'         => 1,
                    'brand'            => 1,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 4',
                        'ar' => 'المنتج الرابع'
                    ],
                    'category'         => 1,
                    'brand'            => 1,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 5',
                        'ar' => 'المنتج الخامس'
                    ],
                    'category'         => 2,
                    'brand'            => 2,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 6',
                        'ar' => 'المنتج السادس'
                    ],
                    'category'         => 2,
                    'brand'            => 2,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 7',
                        'ar' => 'المنتج السابع'
                    ],
                    'category'         => 2,
                    'brand'            => 2,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 8',
                        'ar' => 'المنتج الثامن'
                    ],
                    'category'         => 2,
                    'brand'            => 2,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 9',
                        'ar' => 'المنتج السابع'
                    ],
                    'category'         => 2,
                    'brand'            => 2,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
            [
                'info'       => [
                    'name'             => [
                        'en' => 'Product 10',
                        'ar' => 'المنتج العاشر'
                    ],
                    'category'         => 3,
                    'brand'            => 3,
                    'group'            => 1,
                    'banner'           => 1,
                    'buying_price'     => 80,
                    'selling_price'    => 100,
                    'variation_price'  => 100,
                    'double_price_for_two_lens' => 200,
                    'purchasable'      => Ask::YES,
                    'refundable'       => Ask::YES,
                    'flash_sale'       => Ask::YES,
                    'discount'         => 20,
                    'offer_start_date' => now(),
                    'offer_end_date'   => Carbon::now()->addDay(365),
                    'description'      => [
                        'en' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                        'ar' => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>",
                    ],
                    'size'             => 1.8,
                    'arm'              => 18,
                    'bridge'           => 1.2,
                    'image_featured'   => 'image.png'
                ],
                'seo'        => [
                    'title'        => 'Classic Sweatshirt',
                    'meta_keyword' => ['Hoodies', 'Sweatshirts'],
                    'description'  => "<p>The Classic French Terry Crew brings super-soft comfort to a style that's tried and</p><p>true. It's a top you'll want to wear every day, and it's comfortable and durable enough that you can.&nbsp;&nbsp;</p><p><br></p><p>Soft Comfort</p><p>French terry fabric is lightweight, soft, and comfortable.&nbsp;&nbsp;</p><p><br></p><p>Durable Style</p><p>Reinforced shoulder seams and ribbing enhance durability.&nbsp;&nbsp;</p><p><br></p><p>Product Details</p><ul><li>Ribbing at the hem and cuffs</li><li>Back neck tape</li><li>Fabric:80% cotton: 20% polyester</li><li>Machine wash</li><li>Imported</li><li>Colour Shown: Black/White</li><li>Style: BV2666-010</li></ul>"
                ],
                'taxes'      => [2, 4],
                'tags'       => ['Hoodies', 'Sweatshirts'],
                'image_path' => 'men/clothing',
                'images'     => [1, 2, 3, 4]
            ],
        ];

        $envService = new EnvEditor();
        if ($envService->getValue('DEMO') && $envService->getValue('DISPLAY') == 'fashion') {
            foreach ($fashionProducts as $key => $fashionProduct) {
                $productObject = Product::create([
                    'name'                         => $fashionProduct['info']['name'],
                    'slug'                         => Str::slug($fashionProduct['info']['name']['en'] . $key),
                    'sku'                          => date('is') . $key,
                    'product_category_id'          => $fashionProduct['info']['category'],
                    'product_brand_id'             => $fashionProduct['info']['brand'],
                    'barcode_id'                   => 1,
                    'unit_id'                      => 1,
                    'buying_price'                 => $fashionProduct['info']['buying_price'],
                    'selling_price'                => $fashionProduct['info']['selling_price'],
                    'variation_price'              => $fashionProduct['info']['variation_price'],
                    'status'                       => Status::ACTIVE,
                    'order'                        => 1,
                    'can_purchasable'              => $fashionProduct['info']['purchasable'],
                    'show_stock_out'               => Activity::DISABLE,
                    'maximum_purchase_quantity'    => 100,
                    'low_stock_quantity_warning'   => 2,
                    'refundable'                   => $fashionProduct['info']['refundable'],
                    'add_to_flash_sale'            => $fashionProduct['info']['flash_sale'],
                    'discount'                     => $fashionProduct['info']['discount'],
                    'offer_start_date'             => $fashionProduct['info']['offer_start_date'],
                    'offer_end_date'               => $fashionProduct['info']['offer_end_date'],
                    'shipping_type'                => ShippingType::FLAT_RATE,
                    'shipping_cost'                => 80,
                    'points'                       => 800,
                    'size'                         => $fashionProduct['info']['size'],
                    'arm'                          => $fashionProduct['info']['arm'],
                    'bridge'                       => $fashionProduct['info']['bridge'],
                    'image_featured'               => $fashionProduct['info']['image_featured'],
                    'is_product_quantity_multiply' => Ask::NO,
                    'description'                  => $fashionProduct['info']['description'],
                    'shipping_and_return'          => "<ul><li>We offer extended returns throughout the holiday season. All purchases made between November 6, 2023, through January 7, 2024, can be returned until Jan 31, 2024. Returns are accepted by mail and in-store. Items must be unworn and tags must be attached.</li><li>A flat rate of $4.95 USD will be deducted from your refund for returns.</li><li>Once a return is received, please allow 7-14 business days to process and 3-5 business days for the refund to be credited to the payment method used at the time of purchase.</li><li>We do not offer item exchanges for online orders at this time. To exchange an item for a new size or color you must return the unwanted item(s) and place a new web order for the desired item(s). Your returned item will be processed and a refund will be granted to the original form of payment as long as the item meets our return policy terms. Availability of replacement items is not guaranteed.</li></ul><p><br></p><p><br></p><p><br></p><p><br></p>",
                ]);

                if (isset($fashionProduct['taxes']) && count($fashionProduct['taxes'])) {
                    foreach ($fashionProduct['taxes'] as $tax) {
                        ProductTax::create([
                            'product_id' => $productObject->id,
                            'tax_id'     => $tax
                        ]);
                    }
                }

                if (isset($fashionProduct['tags']) && count($fashionProduct['tags'])) {
                    foreach ($fashionProduct['tags'] as $tag) {
                        ProductTag::create([
                            'product_id' => $productObject->id,
                            'name'       => $tag
                        ]);
                    }
                }

                if (isset($fashionProduct['seo'])) {
                    $productSeo = ProductSeo::create([
                        'product_id'   => $productObject->id,
                        'title'        => $fashionProduct['seo']['title'],
                        'meta_keyword' => json_encode($fashionProduct['seo']['meta_keyword']),
                        'description'  => $fashionProduct['seo']['description']
                    ]);
//                    if (isset($fashionProduct['images']) && count($fashionProduct['images'])) {
//                        if (file_exists(public_path('/images/seeder/product/' . env('DISPLAY') . '/' . $fashionProduct['image_path'] . '/' . strtolower(str_replace(' ', '_', $fashionProduct['info']['name'])) . '/' . '1.png'))) {
//                            $productSeo->addMedia(public_path('/images/seeder/product/' . env('DISPLAY') . '/' . $fashionProduct['image_path'] . '/' . strtolower(str_replace(' ', '_', $fashionProduct['info']['name'])) . '/' . '1.png'))->preservingOriginal()->toMediaCollection('product-seo');
//                        }
//                    }
                }

//                if (isset($fashionProduct['images']) && count($fashionProduct['images'])) {
//                    foreach ($fashionProduct['images'] as $image) {
//                        if (file_exists(public_path('/images/seeder/product/' . env('DISPLAY') . '/' . $fashionProduct['image_path'] . '/' . strtolower(str_replace(' ', '_', $fashionProduct['info']['name'])) . '/' . $image . '.png'))) {
//                            $productObject->addMedia(public_path('/images/seeder/product/' . env('DISPLAY') . '/' . $fashionProduct['image_path'] . '/' . strtolower(str_replace(' ', '_', $fashionProduct['info']['name'])) . '/' . $image . '.png'))->preservingOriginal()->toMediaCollection('product');
//                        }
//                    }
//                }
            }
        }
    }
}
