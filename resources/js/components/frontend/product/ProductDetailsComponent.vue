<template>
    <LoadingComponent :props="loading"/>
    <section class="mb-12 mt-8">
        <div class="container">
            <div class="row">
                <div class="imgsize mb-6 flex col-12 sm:col-6 lg:col-7">
                    <div class="imgsize col-12 sm:col-6 lg:col-8">
                        <Swiper dir="ltr" :spaceBetween="5" :navigation="true" :thumbs="{ swiper: thumbsSwiper }"
                                :modules="modules" class="gallery-swiper">
                            <SwiperSlide class="imgsize">
                                <img class="rounded-2xl imgsize" src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="width:565px; height: 705px;object-fit: cover"/>
                            </SwiperSlide>
                            <SwiperSlide>
                                <img class="rounded-2xl imgsize" src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="width:565px; height: 705px;object-fit: cover"/>
                            </SwiperSlide>
                            <SwiperSlide>
                                <img class="rounded-2xl imgsize" src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="width:565px; height: 705px;object-fit: cover"/>
                            </SwiperSlide>
                            <SwiperSlide  >
                                <img class="rounded-2xl imgsize" src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="width:565px; height: 705px;object-fit: cover"/>
                            </SwiperSlide>
                        </Swiper>
                    </div>
                    <div class="col-12 sm:col-6 lg:col-3 hidden sm:block">
                        <Swiper dir="ltr" @swiper="setThumbsSwiper" :freeMode="true"
                                :watchSlidesProgress="true" :modules="modules" class="thumb-swiper swiper-vertical">
                            <SwiperSlide style="width:87px;">
                                <img src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="height:116px; width: 87px; object-fit: cover"/>
                            </SwiperSlide>
                            <SwiperSlide style="width:87px;">
                                <img src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="height:116px; width: 87px"/>
                            </SwiperSlide>
                            <SwiperSlide style="width:87px;">
                                <img src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="height:116px; width: 87px"/>
                            </SwiperSlide>
                            <SwiperSlide style="width: 87px;">
                                <img src="/طول-1410-عرض-1130.jpg" alt="gallery" loading="lazy" style="height:116px; width: 87px"/>
                            </SwiperSlide>
                        </Swiper>
                    </div>
                </div>


                <div class="col-12 sm:col-6 lg:col-5 lg:pl-10" style="direction: rtl">
                    <h2 class="text-3xl sm:text-4xl font-bold capitalize mb-1">{{ getLocalized(temp.brand.name) }}</h2>
                    <h4 class="text-2xl sm:text-3xl mb-5">{{ getLocalized(product.name) }}</h4>
                    <h3 class="flex items-start gap-4 mb-5">
                        <span class="text-2xl font-bold">
                            {{
                                currencyFormat(temp.price, setting.site_digit_after_decimal_point,
                                    setting.site_default_currency_symbol, setting.site_currency_position)
                            }}
                        </span>
                        <del class="text-lg font-bold text-shopperz-red">
                            {{
                                currencyFormat(temp.oldPrice, setting.site_digit_after_decimal_point,
                                    setting.site_default_currency_symbol, setting.site_currency_position)
                            }}
                        </del>
                    </h3>

                    <VariationComponent v-if="initialVariations.length > 0 && variationComponent"
                                        :method="selectedVariationMethod"
                                        :variations="initialVariations"/>

                    <dl class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-8">
                        <div class="flex flex-col md:flex-row gap-1">
                            <div class="flex flex-col items-center md:items-start">
                                <div class="rem flex items-center border rounded-lg border-gray-300 p-4 md:w-60" style="width: 15rem;">
                                    <p
                                        class="text-sm font-medium text-right leading-5 text-gray-900"
                                        dir="rtl"
                                    >
                                        أو قسمها على 4 دفعات شهرية بقيمة 444.75 ر.س. <a href="#" class="font-semibold" style="color:#553C9A">لمعرفة المزيد</a>
                                    </p>
                                </div>
                                <img
                                    src="/Tamara.png"
                                    alt="Tamara"
                                    class="w-14 h-6"
                                    style="margin-top: -14px"
                                />
                            </div>
                            <div class="flex flex-col items-center md:items-start">
                                <div class="rem flex items-center border rounded-lg border-gray-300 p-4 md:w-60" style="width: 15rem;">
                                    <p
                                        class="text-sm font-medium text-right leading-5 text-gray-900"
                                        dir="rtl"
                                    >
                                        أو قسمها على 4 دفعات شهرية بقيمة 444.75 ر.س. <a href="#" class="font-semibold" style="color:#553C9A">لمعرفة المزيد</a>
                                    </p>
                                </div>
                                <img
                                    src="/tabby.png"
                                    alt="Tabby"
                                    class="w-13 h-6"
                                    style="margin-top: -14px"
                                />
                            </div>
                        </div>
                    </dl>

                    <dl v-if="temp.quantity > 1" class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-8">
                        <dt class="capitalize text-lg font-semibold">{{ $t('label.total_price') }}:</dt>
                        <dd class="flex items-center gap-6 text-green-500 font-semibold text-lg">
                            {{
                                currencyFormat(temp.totalPrice, setting.site_digit_after_decimal_point,
                                    setting.site_default_currency_symbol, setting.site_currency_position)
                            }}
                        </dd>
                    </dl>

                    <div class="flex flex-col gap-3">
                        <div class="flex justify-between items-center px-4">
                            <p class="text-lg font-semibold" dir="rtl">{{ $t('label.lenses_color') }}</p>
                            <p class="text-base font-normal" dir="rtl">{{ $t('label.available') }} 24 {{ $t('label.color') }}</p>
                        </div>
                        <swiper
                            :slides-per-view="8"
                            :space-between="10"
                            class="mySwiper"
                        >
                            <!-- Repeating items for the color options -->
                            <swiper-slide
                                v-for="(color, index) in colors"
                                :key="index"
                                :class="{'border-2 border-blue-600': selectedColor === color.name}"
                                class="flex flex-col items-center gap-1 cursor-pointer"
                                @click="selectColor(color.name)"
                            >
                                <img :src="color.src" alt="Color option" class="w-14 h-14">
                                <p class="text-sm font-medium" dir="rtl">{{ color.name }}</p>
                            </swiper-slide>
                        </swiper>
                    </div>

                    <div class="flex border-b gap-5" style="justify-content: center;">
                        <div
                            :class="['w-1/2 text-center py-4 text-lg font-semibold', { 'text-black border-b-2 border-black': currentTab === 'بدون مقاس', 'text-gray-500 bg-lavui': currentTab !== 'بدون مقاس' }]"
                            @click="currentTab = 'بدون مقاس'"
                            style="width: 50%;"
                        >
                            <button class="focus:outline-none">{{ $t('label.without_size') }}</button>
                        </div>
                        <div
                            :class="['text-center py-4 text-lg font-semibold', { 'text-black border-b-2 border-black': currentTab === 'بمقاس', 'text-gray-500 bg-lavui': currentTab !== 'بمقاس' }]"
                            @click="currentTab = 'بمقاس'"
                            style="width: 50%;"
                        >
                            <button class="focus:outline-none">{{ $t('label.with_size') }}</button>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="mt-8 px-8" v-if="currentTab === 'بدون مقاس'">
                    </div>

                    <div class="mt-8 px-8" v-else-if="currentTab === 'بمقاس'">
                        <div class="col-6 p-0 gap-2">
                            <label class="block mb-2 text-right font-medium text-gray-700">{{ $t('label.lenticular_field') }}</label>
                            <div class="flex items-center border rounded-md p-1 h-10">
                                <select class="flex-1 outline-none">
                                    <option>+4</option>
                                    <option>+4</option>
                                    <option>+4</option>
                                    <option>+4</option>
                                    <option>+4</option>
                                    <option>+4</option>
                                </select>
                            </div>
                        </div>

                        <input type="checkbox" placeholder="مقاس النظر" >
                        <label>مقاس مختلف لكل عين</label>

                    </div>
                    <div class="flex flex-grow h-5 mx-2"></div>



                    <div class="flex flex-wrap items-center gap-8 mb-10">
                        <button @click.prevent="addToCart" :disabled="enableAddToCardButton" type="button"
                                :class="enableAddToCardButton === false ? 'shadow-btn-primary !bg-primary' : ''"
                                class="flex items-center gap-3 px-8 h-12 leading-12 rounded-xl transition-all duration-500 bg-lavui"
                                style="width: 70%; display: flex;justify-content: center; color: white"
                        >

                            <span class="whitespace-nowrap font-bold">{{ $t('label.add_to_cart') }}</span>
                            <i class="lab-line-bag text-xl"></i>
                        </button>
                        <button type="button"
                                @click="wishlist(product.wishlist = !product.wishlist)"
                                :class="product.wishlist ? 'text-primary' : 'text-secondary'"
                                class="flex items-center gap-3 px-8 h-12 leading-12 rounded-xl transition-all duration-500 shadow-btn-secondary bg-white">
                            <i :class="product.wishlist ? 'lab-fill-heart' : 'lab-line-heart'"
                               class="lab-line-heart text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-12">
        <div class="container">
            <div class="row">
                <div class="col-12" dir="rtl">
                    <div class="rounded-[10px] border border-[#D9DBE9]">
                        <nav class="flex flex-wrap items-center p-4 sm:py-6 sm:px-8 gap-1 sm:gap-6">
                            <button type="button"
                                    @click.prevent="multiTargets($event, 'tab-btn', 'tab-div', 'tab_details')"
                                    class="fent tab-btn active text-sm sm:text-base font-bold leading-5 capitalize py-2 sm:py-3.5 px-4 sm:px-8 rounded-xl">
                                {{ $t('label.product_information') }}
                            </button>

                            <button type="button"
                                    @click.prevent="multiTargets($event, 'tab-btn', 'tab-div', 'tab_videos')"
                                    class="fent tab-btn text-sm sm:text-base font-bold leading-5 capitalize py-2 sm:py-3.5 px-4 sm:px-8 rounded-xl ">
                                {{ $t('label.designer') }}
                            </button>

                            <button type="button"
                                    @click.prevent="multiTargets($event, 'tab-btn', 'tab-div', 'tab_reviews')"
                                    class="fent tab-btn text-sm sm:text-base font-bold leading-5 capitalize py-2 sm:py-3.5 px-4 sm:px-8 rounded-xl ">
                                {{ $t('label.feature') }}
                            </button>
                            <button type="button"
                                    @click.prevent="multiTargets($event, 'tab-btn', 'tab-div', 'tab_shipping_and_return')"
                                    class="fent tab-btn text-sm sm:text-base font-bold leading-5 capitalize py-2 sm:py-3.5 px-4 sm:px-8 rounded-xl ">
                                {{ $t('label.shipping_return') }}
                            </button>
                        </nav>

                        <div id="tab_details" class="tab-div active p-4 sm:p-8 sm:pt-6 border-t border-[#D9DBE9]">
                            <div class="flex flex-col gap-8 p-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.size') }}</span>
                                    <span class="text-lg font-medium text-gray-400">53/135/22</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.material') }}</span>
                                    <span class="text-lg font-medium text-gray-400">اسيتات</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.designer_mark') }}</span>
                                    <span class="text-lg font-medium text-gray-400">ميو ميو</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.frame_type') }}</span>
                                    <span class="text-lg font-medium text-gray-400">اطار كامل</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.frame_shape') }}</span>
                                    <span class="text-lg font-medium text-gray-400">كات اي</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-gray-900">{{ $t('label.sku') }}</span>
                                    <span class="text-lg font-medium text-gray-400">8056597671934</span>
                                </div>
                            </div>
                        </div>

                        <div id="tab_videos" class="tab-div p-4 sm:p-8 sm:pt-6 border-t border-[#D9DBE9]">
                            <div class="flex flex-col sm:flex-row p-4 sm:p-8 gap-5" style="direction: ltr">
                                <img src="/mosamm.jpeg" alt="Dior Banner" class="w-full sm:w-1/2 h-auto" />
                                <div class="sm:pl-6 flex flex-col justify-center w-full sm:w-1/2">
                                    <p class="text-lg font-medium text-right text-gray-900 leading-relaxed" dir="rtl">
                                        {{ getLocalized(temp.brand.description) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="tab_reviews" class="tab-div p-4 sm:p-8 sm:pt-6 border-t border-[#D9DBE9]">
                            <div class="bg-gray-100 p-8">
                                <ol class=" text-lg font-medium text-right text-gray-900 leading-relaxed pr-4" dir="rtl">
                                    <li>
                                        -قصة بتصميم بتصميم عين القطة بحافة كاملة مصنوع من الأسيتات باللون الأسود الرقيق
                                    </li>
                                    <li>
                                        -تضمن وسادات الأنف المدمجة ملاءمة آمنة ومريحة.
                                    </li>
                                    <li>
                                        -أذرع سميكة مرفوعة بشعار الماركة الأيقوني من المعدن الذهبي
                                    </li>
                                    <li>
                                        -توفر العدسات الرمادية الداكنة الوضوح والحماية الممتازة من الأشعة فوق البنفسجية
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div id="tab_shipping_and_return" class="tab-div p-4 sm:p-8 sm:pt-6 border-t border-[#D9DBE9]">
                            <h3 class="capitalize text-2xl sm:text-3xl font-bold mb-4">
                                {{ $t('label.product_shipping_and_return') }}</h3>
                            <div class="text-description" v-html="product.shipping_and_return"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section v-if="relatedProducts.length > 0" class="mb-10 sm:mb-20">
        <div class="container">
            <div class="flex items-center justify-between gap-4 mb-5 sm:mb-7">
                <h2 class="text-2xl sm:text-4xl font-bold capitalize">
                    {{ $t('label.related_products') }}
                </h2>
            </div>
            <div>
                <ProductRelatedComponent />
            </div>

            <div class="mt-5 mb-5">
                <GeneralBannerComponent />
            </div>
        </div>
    </section>

</template>

<script>
import {ref} from "vue";
import {Swiper, SwiperSlide} from 'swiper/vue';
import {FreeMode, Navigation, Thumbs} from 'swiper/modules';
import LoadingComponent from "../components/LoadingComponent";
import targetService from "../../../services/targetService";
import router from "../../../router";
import CategoryBreadcrumbComponent from "../components/CategoryBreadcrumbComponent";
import ProductListComponent from "../components/ProductListComponent";
import VariationComponent from "../components/VariationComponent";
import appService from "../../../services/appService";
import alertService from "../../../services/alertService";
import { useHead } from '@vueuse/head';
import ProductRelatedComponent from "../components/ProductRelatedComponent.vue";
import GeneralBannerComponent from "../home/GeneralBannerComponent.vue";

export default {
    name: "ProductDetailsComponent",
    components: {
        GeneralBannerComponent,
        ProductRelatedComponent,
        VariationComponent,
        ProductListComponent,
        CategoryBreadcrumbComponent,
        Swiper,
        SwiperSlide,
        LoadingComponent
    },
    setup() {
        const thumbsSwiper    = ref(null);
        const setThumbsSwiper = (swiper) => {
            thumbsSwiper.value = swiper;
        };
        return {
            thumbsSwiper,
            setThumbsSwiper,
            modules: [FreeMode, Navigation, Thumbs],
        }
    },
    data() {
        return {
            currentTab: 'بدون مقاس',
            selectedColor: null,
            colors: [
                { name: "بني", src: "/E1.png" },
                { name: "بني", src: "/E2.png" },
                { name: "بني", src: "/E3.png" },
                { name: "بني", src: "/E4.png" },
                { name: "بني", src: "/E5.png" },
                { name: "بني", src: "/E6.png" },
                { name: "بني", src: "/E7.png" },
                { name: "بني", src: "/E8.png" },
            ],
            loading: {
                isActive: false,
            },
            props: {
                search: {
                    slug: null,
                    review_limit: 3
                }
            },
            enableAddToCardButton: true,
            selectedVariation: null,
            productArray: {},
            variationComponent: false,
            initProduct: {
                isVariation: false,
                variationId: null,
                sku: null,
                stock: 0,
                quantity: 1,
                discount: 0,
                price: 0,
                oldPrice: 0,
                totalPrice: 0
            },
            temp: {
                name: "",
                image: "",
                isVariation: false,
                variationId: null,
                productId: 0,
                sku: null,
                stock: 0,
                taxes: {},
                brand: {},
                shipping: {},
                quantity: 1,
                discount: 0,
                price: 0,
                oldPrice: 0,
                totalPrice: 0
            },
        }
    },
    computed: {
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        categories: function () {
            return this.$store.getters["frontendProductCategory/ancestorsAndSelf"];
        },
        initialVariations: function () {
            return this.$store.getters["frontendProductVariation/initialVariation"];
        },
        product: function () {
            return this.$store.getters["frontendProduct/show"];
        },
        images: function () {
            return this.$store.getters["frontendProduct/showImages"];
        },
        videos: function () {
            return this.$store.getters["frontendProduct/showVideos"];
        },
        reviews: function () {
            return this.$store.getters["frontendProduct/showReviews"];
        },
        relatedProducts: function () {
            return this.$store.getters["frontendProduct/relatedProducts"];
        },
    },
    mounted() {
        this.show();
        this.showRelatedProduct();
    },
    methods: {
        getLocalized(nameData) {
            console.log(nameData, typeof nameData);
            const language = this.$i18n.locale || 'en';
            if (nameData != null) {
                return nameData[language] || nameData['en'];
            }
            return '';
        },
        onlyNumber: function (e) {
            return appService.onlyNumber(e);
        },
        currencyFormat: function (amount, decimal, currency, position) {
            return appService.currencyFormat(amount, decimal, currency, position);
        },
        multiTargets: function (event, commonBtnClass, commonDivClass, targetID) {
            targetService.multiTargets(event, commonBtnClass, commonDivClass, targetID)
        },
        wishlist: function (toggle) {
            this.$store.dispatch("frontendWishlist/toggle", {
                product_id: this.product.id,
                toggle: toggle
            }).then((res) => {
            }).catch((err) => {
                if (err.response.status === 401) {
                    this.product.wishlist = false;
                    router.push({name: "auth.login"});
                }
            });
        },
        readMore: function () {
            this.props.search.review_limit += 1;
            this.show();
        },
        show: function () {
            if (typeof this.$route.params.slug !== "undefined") {
                this.loading.isActive  = true;
                this.props.search.slug = this.$route.params.slug;
                this.$store.dispatch("frontendProduct/show", this.props.search).then((res) => {
                    this.initProduct = {
                        isVariation: false,
                        variationId: null,
                        sku: res.data.data.sku,
                        stock: res.data.data.stock,
                        quantity: 1,
                        discount: 0,
                        price: res.data.data.price,
                        oldPrice: res.data.data.old_price,
                        totalPrice: res.data.data.price
                    };
                    this.temp        = {
                        name: res.data.data.name,
                        image: res.data.data.image,
                        isVariation: false,
                        variationId: null,
                        productId: res.data.data.id,
                        sku: res.data.data.sku,
                        stock: res.data.data.stock,
                        taxes: res.data.data.taxes,
                        shipping: res.data.data.shipping,
                        brand: res.data.data.brand,
                        quantity: 1,
                        discount: 0,
                        price: res.data.data.price,
                        oldPrice: res.data.data.old_price,
                        totalPrice: res.data.data.price
                    };

                    this.$store.dispatch("frontendProductCategory/ancestorsAndSelf", res.data.data.category_slug).then((categoryRes) => {
                        this.loading.isActive = false;
                    }).catch((err) => {
                        this.loading.isActive = false;
                    });

                    this.$store.dispatch("frontendProductVariation/initialVariation", res.data.data.id).then((initVariationRes) => {
                        if (initVariationRes.data.data.length > 0) {
                            this.variationComponent = true;
                        }

                        if (!initVariationRes.data.data.length && res.data.data.stock > 0) {
                            this.enableAddToCardButton = false;
                        }
                        this.loading.isActive = false;
                    }).catch((err) => {
                        this.loading.isActive = false;
                    });

                    if(Object.keys(res.data.data.seo) && res.data.data.seo.title && res.data.data.seo.description) {
                        let metaData = [
                            { name: 'title', content: res.data.data.seo.title },
                            { name : 'description', content: res.data.data.seo.description },
                        ];

                        if(res.data.data.seo.thumb && res.data.data.seo.cover) {
                            metaData.push({ content : res.data.data.seo.thumb });
                            metaData.push({ content : res.data.data.seo.cover });
                        }

                        useHead({
                            title : this.setting.company_name + ' - ' + res.data.data.seo.title,
                            meta: metaData
                        });
                    }
                }).catch((err) => {
                    this.loading.isActive = false;
                });
            }
        },
        showRelatedProduct: function () {
            if (typeof this.$route.params.slug !== "undefined") {
                this.loading.isActive  = true;
                this.props.search.slug = this.$route.params.slug;
                this.$store.dispatch("frontendProduct/relatedProducts", {
                    slug: this.$route.params.slug,
                    rand: 8
                }).then((res) => {
                    this.loading.isActive = false;
                }).catch((err) => {
                    this.loading.isActive = false;
                });
            }
        },
        selectedVariationMethod: function (variation) {
            this.enableAddToCardButton = true;
            this.selectedVariation     = null;

            this.temp.isVariation = this.initProduct.isVariation;
            this.temp.variationId = this.initProduct.variationId;
            this.temp.sku         = this.initProduct.sku;
            this.temp.stock       = this.initProduct.stock;
            this.temp.quantity    = this.initProduct.quantity;
            this.temp.discount    = this.initProduct.discount;
            this.temp.price       = this.initProduct.price;
            this.temp.oldPrice    = this.initProduct.oldPrice;
            this.temp.totalPrice  = this.initProduct.price;

            if (variation) {
                this.selectedVariation = variation;

                this.temp.isVariation = true;
                this.temp.variationId = variation.id;
                this.temp.sku         = variation.sku;
                this.temp.stock       = variation.stock;
                this.temp.quantity    = 1;
                this.temp.discount    = 0;
                this.temp.price       = variation.price;
                this.temp.oldPrice    = variation.old_price;
                this.temp.totalPrice  = variation.price;

                if (variation.stock > 0) {
                    this.enableAddToCardButton = false;
                }
            }
        },
        quantityUp: function () {
            if (this.temp.quantity === 0) {
                this.temp.quantity = 1;
            }
            if (this.temp.quantity > this.temp.stock) {
                this.temp.quantity = this.temp.stock
            }
            this.totalPriceSetup();
        },
        quantityIncrement: function () {
            this.temp.quantity++;
            if (this.temp.quantity <= 0) {
                this.temp.quantity = 1;
            }

            if (this.temp.quantity > this.temp.stock) {
                this.temp.quantity--;
            }
            this.totalPriceSetup();
        },
        quantityDecrement: function () {
            this.temp.quantity--;
            if (this.temp.quantity <= 0) {
                this.temp.quantity = 1;
            }
            this.totalPriceSetup();
        },
        totalPriceSetup: function () {
            this.temp.totalPrice = (this.temp.price * this.temp.quantity);
        },
        addToCart: function () {
            this.enableAddToCardButton = true;
            this.productArray          = {
                name: this.temp.name,
                product_id: this.temp.productId,
                image: this.temp.image,
                variation_names: '',
                variation_id: this.temp.variationId,
                sku: this.temp.sku,
                stock: this.temp.stock,
                taxes: this.temp.taxes,
                shipping: this.temp.shipping,
                quantity: this.temp.quantity,
                discount: this.temp.discount,
                price: this.temp.price,
                old_price: this.temp.oldPrice,
                total_price: this.temp.totalPrice
            }

            if (this.selectedVariation) {
                this.$store.dispatch("frontendProductVariation/ancestorsToString", this.selectedVariation.id).then((res) => {
                    this.productArray.variation_names = res.data.data;
                    this.variationComponent           = false;
                    this.$store.dispatch("frontendCart/lists", this.productArray).then((res) => {
                        alertService.success(this.$t('message.add_to_cart'));
                        this.variationComponent = true;
                        this.productArray       = {};
                        this.selectedVariation  = null;
                        this.temp.isVariation   = this.initProduct.isVariation;
                        this.temp.variationId   = this.initProduct.variationId;
                        this.temp.sku           = this.initProduct.sku;
                        this.temp.stock         = this.initProduct.stock;
                        this.temp.quantity      = this.initProduct.quantity;
                        this.temp.discount      = this.initProduct.discount;
                        this.temp.price         = this.initProduct.price;
                        this.temp.oldPrice      = this.initProduct.oldPrice;
                        this.temp.totalPrice    = this.initProduct.price;
                    }).catch((err) => {
                        alertService.error(this.$t('message.maximum_quantity'));
                        this.variationComponent = true;
                        this.selectedVariation  = null;
                        this.temp.stock         = this.initProduct.stock;
                        this.temp.quantity      = this.initProduct.quantity;
                    });
                }).catch((err) => {
                });
            } else {
                this.$store.dispatch("frontendCart/lists", this.productArray).then((res) => {
                    alertService.success(this.$t('message.add_to_cart'));
                    this.enableAddToCardButton = false;
                    this.productArray          = {};
                    this.selectedVariation     = null;
                    this.temp.isVariation      = this.initProduct.isVariation;
                    this.temp.variationId      = this.initProduct.variationId;
                    this.temp.sku              = this.initProduct.sku;
                    this.temp.stock            = this.initProduct.stock;
                    this.temp.quantity         = this.initProduct.quantity;
                    this.temp.discount         = this.initProduct.discount;
                    this.temp.price            = this.initProduct.price;
                    this.temp.oldPrice         = this.initProduct.oldPrice;
                    this.temp.totalPrice       = this.initProduct.price;
                }).catch((err) => {
                    alertService.error(this.$t('message.maximum_quantity'));
                    this.enableAddToCardButton = false;
                    this.selectedVariation     = null;
                    this.temp.stock            = this.initProduct.stock;
                    this.temp.quantity         = this.initProduct.quantity;
                });
            }
        }
    },
    watch: {
        $route() {
            this.show();
            this.showRelatedProduct();
        }
    }
}
</script>
<style scoped>
.mySwiper {
    width: 100%;
    padding: 10px 0;
}
.cursor-pointer {
    cursor: pointer;
}
@media (max-width: 639px) {
    .imgsize{
        height: 396px!important;
    }
    .rem{
        width: 12.5rem!important;
    }
    .fent{
        font-size: 13px!important;
    }
}
</style>
