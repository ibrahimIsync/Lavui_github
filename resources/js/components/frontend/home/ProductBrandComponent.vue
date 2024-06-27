<template>
    <LoadingComponent :props="loading" />

    <section class="mb-3 sm:mb-10 text-center" v-if="brands.length > 1">
        <div class="container">
            <h2 class="ses capitalize text-2xl sm:text-4xl font-bold" style="font-size: 29px">
<!--                {{ $t('label.popular_brands') }}-->
                {{ $t('label.shopbydesigners') }}

            </h2>
            <p class="ses1 mb-8" style="color: #8E8E8E;font-size: 15px">
                {{ $t('label.lorem') }}
            </p>
<!--            class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6"
-->
            <div class="grid grid-cols-3 sm:gap-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div v-for="brand in brands">
                    <router-link :to="{name: 'frontend.product', query:{ brand: brand.id }}" class="w-full">
                        <figure>
                            <img src="/1661011222-PRADA-logo.png" alt="brand" loading="lazy">
                        </figure>
                    </router-link>
                </div>
            </div>

            <button class="py-2 px-4 text-sm sm:py-3 sm:px-6 mt-5 capitalize sm:text-base font-semibold whitespace-nowrap bg-primary-slate text-primary transition-all duration-300 hover:bg-primary hover:text-white ">
                <a href="#"><span style="margin-right: 10px"><i class="fa-solid fa-arrow-left-long"></i></span>{{ $t('label.showall') }}</a>
            </button>

<!--            <Swiper dir="ltr" :speed="1000" :loop="true" :navigation="true" :modules="modules" class="navigate-swiper" :breakpoints="breakpoints">-->
<!--                <SwiperSlide v-for="brand in brands" class="">-->
<!--                    <router-link :to="{name: 'frontend.product', query:{ brand: brand.id }}" class="w-full">-->
<!--                        <figure class="w-full flex items-center justify-center">-->
<!--&lt;!&ndash;                            <img :src="brand.cover" alt="brand" loading="lazy">&ndash;&gt;-->
<!--                            <img src="/1661011222-PRADA-logo.png" alt="brand" loading="lazy">-->
<!--                        </figure>-->
<!--&lt;!&ndash;                        <span class="text-sm sm:text-lg font-medium capitalize text-center pb-3 block group-hover:text-primary">&ndash;&gt;-->
<!--&lt;!&ndash;                                {{ brand.name }}&ndash;&gt;-->
<!--&lt;!&ndash;                            </span>&ndash;&gt;-->
<!--                    </router-link>-->
<!--                </SwiperSlide>-->
<!--            </Swiper>-->
        </div>
    </section>
</template>

<script>
import statusEnum from "../../../enums/modules/statusEnum";
import LoadingComponent from "../components/LoadingComponent";
import {Swiper, SwiperSlide} from "swiper/vue";
import {Autoplay, Navigation, Pagination} from "swiper/modules";
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

export default {
    name: "ProductBrandComponent",
    components: {
        Swiper, SwiperSlide,
        LoadingComponent
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            breakpoints: {
                0: {slidesPerView: 2, spaceBetween: 24},
                640: {slidesPerView: 4, spaceBetween: 24},
                768: {slidesPerView: 5, spaceBetween: 24},
                1024: {slidesPerView: 6, spaceBetween: 40}
            },
        }
    },
    setup() {
        return {
            modules: [Navigation, Pagination, Autoplay],
        }
    },
    computed: {
        brands: function () {
            return this.$store.getters["frontendProductBrand/lists"];
        },
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch("frontendProductBrand/lists", {
            paginate: 0,
            order_column: "id",
            order_type: "asc",
            status: statusEnum.ACTIVE,
        }).then(res => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
    }
}
</script>

<style scoped>
    @media (max-width: 639px) {
        .ses{
            font-size: 19px!important;
        }
        .ses1{
            font-size: 11px;
        }
    }
</style>
