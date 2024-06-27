<template>
    <div class="container text-center">
        <h1 class="text-2xl font-semibold text-gray-800 mb-10">
            {{ $t('label.yourcompleteguidetosunglasses') }}
        </h1>
        <section class="mb-10 sm:mb-20">
            <div class="container">
                <Swiper
                    v-if="products.length > 0"
                    :slides-per-view="3"
                    :speed="1000"
                    :loop="false"
                    :navigation="false"
                    :pagination="false"
                    :autoplay="{ delay: 2500 }"
                    :modules="modules"
                    :breakpoints="{
                  320: {
                    slidesPerView: 1.25,
                    spaceBetween: 10
                  },
                  480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                  },
                  768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                  },
                  1024: {
                    slidesPerView:3,
                    spaceBetween: 10
                  },
                  1200: {
                    slidesPerView:3,
                    spaceBetween: 10
                  }
                }"
                    class="banner-swiper" >
                    <SwiperSlide v-for="product in products" >
                        <div class="flex flex-col items-center space-y-6">
                                <img src="/blog.jpg" alt="image 1" class="ses w-96 h-72">
                                <div class="space-y-4">
                                    <h2 class="sise text-xl font-medium text-gray-900">
                                        {{ $t('label.yourcompleteguidetosunglassesduringthesummerintheMiddleEast') }}
                                    </h2>
                                    <p class="sise1 text-gray-700">
                                        {{ $t('label.discoverthebestproducts') }}
                                    </p>
                                </div>
                            </div>
                    </SwiperSlide>
                </Swiper>
            </div>
        </section>
<!--        <div class="bg-gray-50 py-10 min-h-screen flex flex-col items-center">-->
<!--            <div class="grid gap-5 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3" dir="rtl">-->
<!--                <div class="flex flex-col items-center space-y-6">-->
<!--                    <img src="/blog.jpg" alt="image 1" class="ses w-96 h-72">-->
<!--                    <div class="space-y-4">-->
<!--                        <h2 class="sise text-xl font-medium text-gray-900">-->
<!--                            {{ $t('label.yourcompleteguidetosunglassesduringthesummerintheMiddleEast') }}-->
<!--                        </h2>-->
<!--                        <p class="sise1 text-gray-700">-->
<!--                            {{ $t('label.discoverthebestproducts') }}-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="flex flex-col items-center space-y-6">-->
<!--                    <img src="/blog.jpg" alt="image 2" class="ses w-96 h-72">-->
<!--                    <div class="space-y-4">-->
<!--                        <h2 class="sise text-xl font-medium text-gray-900">-->
<!--                            {{ $t('label.yourcompleteguidetosunglassesduringthesummerintheMiddleEast') }}-->
<!--                        </h2>-->
<!--                        <p class="sise1 text-gray-700">-->
<!--                            {{ $t('label.discoverthebestproducts') }}-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="flex flex-col items-center space-y-6">-->
<!--                    <img src="/blog.jpg" alt="image 3" class="ses w-96 h-72">-->
<!--                    <div class="space-y-4">-->
<!--                        <h2 class="sise text-xl font-medium text-gray-900">-->
<!--                            {{ $t('label.yourcompleteguidetosunglassesduringthesummerintheMiddleEast') }}-->
<!--                        </h2>-->
<!--                        <p class="sise1 text-gray-700">-->
<!--                            {{ $t('label.discoverthebestproducts') }}-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>

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
        name: "CategoryComponent",
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
    };
</script>

<style scoped>
    @media (max-width: 639px) {
        .ses{
            width: 100%;
            height: 303px;
            object-fit: none;
        }
        .sise{
            font-size: 15px;
        }
        .sise1{
            font-size: 13px;
        }
    }
</style>


<!--<script>-->

<!--import statusEnum from "../../../enums/modules/statusEnum";-->
<!--import {Swiper, SwiperSlide} from 'swiper/vue';-->
<!--import promotionTypeEnum from "../../../enums/modules/promotionTypeEnum";-->
<!--import LoadingComponent from "../components/LoadingComponent";-->

<!--export default {-->
<!--    name: "PromotionComponent",-->
<!--    components: {-->
<!--        Swiper,-->
<!--        SwiperSlide,-->
<!--        LoadingComponent-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            loading: {-->
<!--                isActive: false,-->
<!--            },-->
<!--            breakpoints: {-->
<!--                0: {slidesPerView: 'auto', spaceBetween: 16},-->
<!--                640: {slidesPerView: 3, spaceBetween: 24},-->
<!--            }-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        promotions: function () {-->
<!--            return this.$store.getters["frontendPromotion/lists"];-->
<!--        },-->
<!--    },-->
<!--    mounted() {-->
<!--        this.loading.isActive = true;-->
<!--        this.$store.dispatch("frontendPromotion/lists", {-->
<!--            paginate: 0,-->
<!--            order_column: "id",-->
<!--            order_type: "asc",-->
<!--            type: promotionTypeEnum.SMALL,-->
<!--            status: statusEnum.ACTIVE,-->
<!--        }).then(res => {-->
<!--            this.loading.isActive = false;-->
<!--        }).catch((err) => {-->
<!--            this.loading.isActive = false;-->
<!--        });-->
<!--    },-->
<!--}-->
<!--</script>-->
