<template>
    <LoadingComponent :props="loading" />
    <section class="mb-10 sm:mb-20 mt-5">
        <div class="container">
            <img class="RES w-full mb-3" src="/mean_slider.jpg" alt="banner" loading="lazy" style="height: 266px;object-fit: cover">
            <Swiper v-if="sliders.length > 0" :slides-per-view="1" :speed="1000" :loop="true" :navigation="false"
                    :pagination="{ clickable: true }" :autoplay="{ delay: 2500 }" :modules="modules"
                    class="banner-swiper res">
                <SwiperSlide v-for="slider in sliders">
                    <div v-if="slider.link">
                        <a :href="slider.link">
                            <img class="w-full" :src="slider.image" alt="banner" loading="lazy">
                        </a>
                    </div>
                    <div v-else>
                        <!--                        <img class="w-full" :src="slider.image" alt="banner" loading="lazy">-->
                        <img class="w-full sise" src="/discount.png" alt="banner" loading="lazy" style="height: 454px">
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </section>
</template>

<script>
import 'swiper/css';
import {Navigation, Pagination, Autoplay} from 'swiper/modules';
import {Swiper, SwiperSlide} from 'swiper/vue';
import statusEnum from "../../../enums/modules/statusEnum";
import LoadingComponent from "../components/LoadingComponent";

export default {
    name: "SliderComponent",
    components: {
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
        sliders: function () {
            return this.$store.getters['frontendSlider/lists'];
        }
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch("frontendSlider/lists", this.sliderProps.search).then((res) => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
    }
}
</script>
<style scoped>
@media (max-width: 639px) {
    .RES{
        height: 128px!important;
    }
    .res{
        height: 178px!important;
    }
    .sise{
        height: 179px!important;
    }
}

</style>
