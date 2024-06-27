<template>
    <LoadingComponent :props="loading"/>

<!--    <div class="p-0 m-0" v-if="productSections.length > 0 && promotions.length > 0" v-for="(productSection, key) in productSections">-->
<!--        <section class="mb-10 sm:mb-20" v-if="productSection.products.length > 0">-->
<!--            <div class="container">-->
<!--                <div class="flex items-center justify-between gap-4 mb-5 sm:mb-7">-->
<!--                    <h2 class="text-2xl sm:text-4xl font-bold capitalize">-->
<!--                        {{ productSection.name }}-->
<!--                    </h2>-->
<!--                    <router-link v-if="productSections.length === 8" :to="{name: 'frontend.productSection.products', params: { slug: productSection.slug }}" class="py-2 px-4 text-sm sm:py-3 sm:px-6 rounded-3xl capitalize sm:text-base font-semibold whitespace-nowrap bg-primary-slate text-primary transition-all duration-300 hover:bg-primary hover:text-white">-->
<!--                        {{ $t('label.show_more') }}-->
<!--                    </router-link>-->
<!--                </div>-->
<!--                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2 sm:gap-2">-->
<!--                    <ProductListComponent v-if="productSection.products.length > 0"-->
<!--                                          :products="productSection.products"/>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->

<!--        <div v-for="(promotion, promotionKey) in promotions" class="p-0 m-0">-->
<!--            <section v-if="key === promotionKey" class="mb-10 sm:mb-20">-->
<!--                <div class="container">-->
<!--                    <router-link :to="{name: 'frontend.promotion.products', params: { slug: promotion.slug }}">-->
<!--                        <img class="w-full rounded-3xl" :src="promotion.preview" alt="promotion" loading="lazy">-->
<!--                    </router-link>-->
<!--                </div>-->
<!--            </section>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="p-0 m-0" v-else-if="productSections.length > 0" v-for="productSection in productSections">-->
<!--        <section class="mb-10 sm:mb-20" v-if="productSection.products.length > 0">-->
<!--            <div class="container">-->
<!--                <div class="flex items-center justify-between gap-4 mb-5 sm:mb-7">-->
<!--                    <h2 class="text-2xl sm:text-4xl font-bold capitalize">-->
<!--                        {{ productSection.name }}-->
<!--                    </h2>-->
<!--                    <router-link v-if="productSections.length === 8" :to="{name: 'frontend.productSection.products', params: { slug: productSection.slug }}" class="py-2 px-4 text-sm sm:py-3 sm:px-6 rounded-3xl capitalize sm:text-base font-semibold whitespace-nowrap bg-primary-slate text-primary transition-all duration-300 hover:bg-primary hover:text-white">-->
<!--                        {{ $t('label.show_more') }}-->
<!--                    </router-link>-->
<!--                </div>-->
<!--                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">-->
<!--                    <ProductListComponent v-if="productSection.products.length > 0" :products="productSection.products"/>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->

<!--    <div class="p-0 m-0" v-else-if="promotions.length > 0">-->
<!--        <section v-for="promotion in promotions" class="mb-10 sm:mb-20">-->
<!--            <div class="container">-->
<!--                <router-link :to="{name: 'frontend.promotion.products', params: { slug: promotion.slug }}">-->
<!--                    <img class="w-full rounded-3xl" :src="promotion.preview" alt="promotion" loading="lazy">-->
<!--                </router-link>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->
    <section class="mb-10 sm:mb-20">
        <div class="container" dir="rtl">
            <div class="flex items-center justify-between gap-4 mb-5 sm:mb-7">
                <h2 class="ses text-center text-2xl sm:text-4xl font-bold capitalize" style="font-size: 29px">
                    <!--                    {{ productSection.name }}-->
                    {{ $t('label.youneednewglasses') }}
                </h2>
<!--                                <router-link v-if="productSections.length === 8" :to="{name: 'frontend.productSection.products', params: { slug: productSection.slug }}" class="py-2 px-4 text-sm sm:py-3 sm:px-6 rounded-3xl capitalize sm:text-base font-semibold whitespace-nowrap bg-primary-slate text-primary transition-all duration-300 hover:bg-primary hover:text-white">-->
<!--                                    {{ $t('label.show_more') }}-->
<!--                                </router-link>-->
                <router-link v-if="products.length === 8" :to="{name: 'frontend.mostPopular.products'}" class="ses1 py-2 px-4 text-sm sm:py-3 sm:px-6 capitalize sm:text-base font-semibold whitespace-nowrap text-primary transition-all duration-300" style="text-decoration: underline">
                    {{ $t('label.showallproducts') }}
                </router-link>
            </div>

        </div>
    </section>
</template>

<script>
    import 'swiper/css';
    import {Navigation, Pagination, Autoplay} from 'swiper/modules';
    import {Swiper, SwiperSlide} from 'swiper/vue';
    import statusEnum from "../../../enums/modules/statusEnum";
    import LoadingComponent from "../components/LoadingComponent";
    import ProductListComponent from "../components/ProductListComponent.vue";
    import CardComponent from "../components/CardComponent.vue";


    export default {
        name: "ProductTrendComponent",
        components: {
            CardComponent,
            ProductListComponent,
            Swiper,
            SwiperSlide,
            LoadingComponent
        },
        setup() {
            return {
                modules: [Navigation, Pagination, Autoplay],
            }
        },
        data() {
            return {
                loading: {
                    isActive: false
                },
                sliderProps: {
                    search: {
                        paginate: 0,
                        order_column: 'id',
                        order_type: 'desc',
                        status: statusEnum.ACTIVE
                    }
                }
            }
        },
        computed: {
            products: function () {
                return this.$store.getters["frontendProduct/popularProducts"];
            },
        },
        mounted() {
            this.loading.isActive = true;
            this.$store.dispatch("frontendProduct/popularProducts", {
                paginate: 0,
                rand: 8
            }).then(res => {
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
    }
</script>
<style scoped>
    @media (max-width: 639px) {
        .ses{
        font-size: 15px!important;
        }
        .ses1{
            font-size: 13px;
        }
    }
</style>
