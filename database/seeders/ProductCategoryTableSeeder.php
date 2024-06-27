<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {

            $fashionCategories = [
                [
                    'name'       => [
                        'en' => 'sunglasses',
                        'ar' => 'النظارات الشمسية',
                    ],
                    'description'       => [
                        'en' => 'Explore our exquisite collection of sunglasses tailored for You, where luxury and elegance unite with contemporary designs and cutting-edge functionality. These sunglasses provide you with comprehensive protection from harmful sunrays in a graceful and sophisticated manner. Every detail has been thoughtfully curated to reflect your personality and refined taste. Your choice of these pieces signifies your uniqueness and adds a touch of beauty to your ensemble. ',
                        'ar' => 'استكشفي مجموعتنا الراقية من النظارات الشمسية المخصصة للسيدات، حيث تجتمع الفخامة والأناقة بتصاميم عصرية ووظائف عالية التقنية. تمنحكِ هذه النظارات الحماية الشاملة من أشعة الشمس الضارة بأسلوب أنيق وراقٍ. اخترنا بعناية كل تفصيل ليعكس شخصيتكِ وذوقكِ الرفيع. اختياركِ لهذه القطع يعبر عن تميزكِ ويضيف لمسة من الجمال إلى إطلالتكِ. ',
                    ],
                    'slug'        => Str::slug('sunglasses'),
                    'image'       => 'image.png',
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'eyeglasses',
                        'ar' => 'النظارات الطبية',
                    ],
                    'description'       => [
                        'en' => 'Experience a unique journey with our splendid and contemporary collection of eyeglasses, where beauty intertwines seamlessly with exceptional functionality. Innovative designs enhance your femininity and safeguard your vision. Choose from our diverse selection that reflects your refined taste. Explore the world\'s beauty with clarity and elegance',
                        'ar' => 'استمتعي بتجربة فريدة مع مجموعة النظارات الطبية الرائعة والعصرية، حيث تلتقي الجمال والوظائف المتفوقة. تصاميم مبتكرة تعزز أنوثتك وتحمي رؤيتك، اختاري من تشكيلتنا المتنوعة التي تعبر عن ذوقك الرفيع. اكتشفي جمال العالم بوضوح وأناقة. ',
                    ],
                    'slug'        => Str::slug('eyeglasses'),
                    'image'       => 'image.png',
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'contact lenses',
                        'ar' => 'النظارات الطبية',
                    ],
                    'description'       => [
                        'en' => 'Embark on a new world with contact lenses, where beauty seamlessly intertwines with exceptional functionality. A comfortable experience that accentuates the allure of your eyes and ensures clarity of vision. Choose from our distinctive collection tailored to your style. Attain a look of enchantment and allure. ',
                        'ar' => 'اكتشفي عالماً جديدا مع العدسات اللاصقة، حيث تنسجم الجمال مع الوظائف المتفوقة. تجربة مريحة تبرز جمال عيونك" وتحقق وضوح رؤيتك. اختاري من تشكيلتنا المميزة التي تلبي أسلوبك. احصلي على إطلالة غاية في السحر والجاذبية. ',
                    ],
                    'slug'        => Str::slug('contact lenses'),
                    'image'       => 'image.png',
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'accessories',
                        'ar' => 'النظارات الطبية',
                    ],
                    'description'       => [
                        'en' => 'Discover a fantastic collection of accessories, adorned with unique details, to elegantly enhance your look. From stylish cases to exquisite straps, choose from our distinctive range to add a special touch that highlights the beauty of your eyewear. Indulge in individuality and allure.',
                        'ar' => 'اكتشفي مجموعة رائعة من الإكسسوارت بتفاصيل فريدة تزيّن إطلالتك بأناقة متفردة، من حافظات أنيقة إلى أشرطة رائعة. اختاري من تشكيلتنا المميزة لتبرزي جمال نظاراتك بلمسة خاصة. استمتعي بالتفرد والجاذبية. ',
                    ],
                    'slug'        => Str::slug('accessories'),
                    'image'       => 'image.png',
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'brands',
                        'ar' => 'علامة مصممين',
                    ],
                    'description'       => null,
                    'slug'        => Str::slug('brands'),
                    'image'       => 'image.png',
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
            ];

            foreach ($fashionCategories as $fashionCategory) {
                $productCategory = ProductCategory::create($fashionCategory);
//                if (file_exists(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $fashionCategory['name'])) . '.png'))) {
//                    $productCategory->addMedia(public_path('/images/seeder/product-category/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $fashionCategory['name'])) . '.png'))->preservingOriginal()->toMediaCollection('product-category');
//                }
            }
        }
    }
}
