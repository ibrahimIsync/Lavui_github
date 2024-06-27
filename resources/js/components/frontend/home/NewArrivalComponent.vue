<template>
    <LoadingComponent :props="loading" />
    <section class="mb-10 sm:mb-20">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <!-- Swiper Section -->
                <div class="w-full md:col-8 lg:col-8 px-4">
                    <div class="flex items-center justify-between gap-4 sm:mb-3" style="direction: rtl">
                        <h2 class="lres text-2xl sm:text-4xl font-bold capitalize" style="font-size: 29px">
                            <span class="res" style="font-size: 15px;color: #80808066">220 {{ $t('label.newarrivelcount') }}</span>
                            <br>
                            {{ $t('label.newarrivel') }}
                            <br>
                            <span class="sres" style="font-size: 15px;width: 58%;line-height: normal;color: gray">{{ $t('label.newarrivaldescription') }}</span>
                        </h2>
                        <router-link v-if="products.length === 8" :to="{name: 'frontend.mostPopular.products'}" class="rRes py-2 px-4 text-sm sm:py-3 sm:px-6 capitalize sm:text-base font-semibold whitespace-nowrap text-primary transition-all duration-300" style="text-decoration: underline">
                            {{ $t('label.showallproducts') }}
                        </router-link>
                    </div>
                    <Swiper
                        v-if="products.length > 0"
                        :slides-per-view="3"
                        :speed="1000"
                        :loop="true"
                        :navigation="true"
                        :pagination="false"
                        :autoplay="{ delay: 2500 }"
                        :modules="modules"
                        :breakpoints="{
                          320: {
                            slidesPerView: 2.25,
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
                            slidesPerView: 3,
                            spaceBetween: 40
                          },
                          1200: {
                            slidesPerView:3,
                            spaceBetween: 10
                          }
                        }"
                        class="banner-swiper">
                        <SwiperSlide v-for="product in products" :key="product.id">
                            <CardComponent :product="product" />
                        </SwiperSlide>
                    </Swiper>
                </div>
                <!-- Image Section -->
                <div class="w-full RES sm:w-1/3 md:col-4 lg:col-4 px-4">
                    <img class="mb-2" src="/model.jpeg" alt="banner" loading="lazy">
                </div>
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
    name: "NewArrivalComponent",
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
    .RES{
        display: none!important;
    }
    .res{
        font-size: 10px!important;
    }
    .lres{
        font-size: 19px!important;
    }
    .sres{
        width: 100%!important;
        font-size: 10px!important;
    }
    .rRes{
        font-size: 19px!important;
    }
}
</style>

