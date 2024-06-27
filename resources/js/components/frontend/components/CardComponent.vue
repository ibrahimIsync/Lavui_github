<template>
    <div v-if="product" class="sm:p-2 rounded-sm sm:shadow-card transition-all duration-300 sm:hover:shadow-hover group">
        <div class="relative overflow-hidden rounded-xl isolate">
            <button type="button" @click.prevent="wishlist(product, product.wishlist = !product.wishlist)"
                    :class="product.wishlist ? 'lab-fill-heart text-primary' : 'lab-line-heart'"
                    class="w-7 h-7 leading-7 rounded-full text-center text-base shadow-badge absolute top-3 right-3 z-10 bg-white">
            </button>

            <section class="overflow-hidden rounded-xl w-full">
<!--                <section class="product" style="height: 300px">-->
<!--                    <img :src="product.cover" alt="product"-->
<!--                         class="mean_image  w-full rounded-xl" style="height: 300px;" loading="lazy">-->
<!--                    <div class="productHover" style="display: none;">-->
<!--                        <img :src="product.hoverCover" alt="product"-->
<!--                             class=" w-full rounded-xl" style="height: 70%" loading="lazy">-->
<!--                        <div class="hoverImages" style="display: flex; justify-content: space-between;height: 30%">-->
<!--                            <img :src="product.thumbnail1" alt="product"-->
<!--                                 class=" product w-full rounded-xl transition-all duration-300" style="width: 50px; height: 50px;" loading="lazy">-->
<!--                            <img :src="product.thumbnail2" alt="product"-->
<!--                                 class=" product w-full rounded-xl transition-all duration-300" style="width: 50px; height: 50px;" loading="lazy">-->
<!--                            <img :src="product.thumbnail3" alt="product"-->
<!--                                 class=" product w-full rounded-xl transition-all duration-300" style="width: 50px; height: 50px;" loading="lazy">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </section>-->
                <section class="product" style="height: 310px;width: 228px">
                    <router-link :to="{ name: 'frontend.product.details', params: { slug: product.slug }}" style="position: fixed;bottom: 8rem;height: 4rem;">
                    <img src="/vir.png" alt="product"
                         class="emg w-full rounded-xl" style="position: fixed;bottom: 8rem;height: 4rem; display: flex;align-items: center;justify-content: center">
                    </router-link>
                    <img src="/M1.png" alt="product"
                         class="mean_image  w-full rounded-xl" style="height: 310px;position: fixed;" loading="lazy">

                </section>
            </section>
        </div>

        <div class="px-1 sm:px-0 pt-1 pb-1">
            <h3 class="sise capitalize text-base font-semibold whitespace-nowrap transition-all duration-300 hover:text-primary">
                <router-link class="block overflow-hidden text-ellipsis"
                             :to="{ name: 'frontend.product.details', params: { slug: product.slug }}">
                    {{ getLocalized(product.name) }}
                </router-link>
            </h3>

            <div class="sise flex flex-wrap items-center gap-2 mb-2">
                <div class="flex items-center gap-1">
                    <p>{{ getLocalized(product.brand.name) }}</p>
                </div>
            </div>

            <div class="price flex items-center gap-x-3 gap-y-1" v-if="product.is_offer">
                <h3 class="fint text-xl sm:text-[16px] font-bold">
                    <span>{{ product.discounted_price }}</span>
                </h3>
<!--                <h4 class="text-sm sm:text-base font-semibold text-shopperz-red">-->
<!--                    <del>{{ product.currency_price }}</del>-->
<!--                </h4>-->
                <button @click="virtualTry(product)" class="w-full bg-secondary text-white py-2 rounded-md" style="color: #4C338C;font-size:24px;">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </div>
            <h4 class="fint text-xl sm:text-[16px] font-bold" v-else>
                <span>{{ product.currency_price }}</span>
            </h4>
        </div>
        <div class="col-span-2 flex">
<!--            <div class="col-6 sm:col-8 lg:col-8" style="padding: 0px">-->
<!--                <button @click="buyProduct(product)" class="w-full bg-primary text-white py-2 rounded-md" style="color: white; background:black;font-size: small;">-->
<!--                    <i class="fas fa-vr-cardboard"></i> <span style="font-family:'Dubai'; margin-left: 10px;">جربيها عليك</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="col-6 sm:col-4 lg:col-4" style="padding: 1px">-->
<!--                <button @click="virtualTry(product)" class="w-full bg-secondary text-white py-2 rounded-md" style="color: white; background:blueviolet;font-size: small;">-->
<!--                    <i class="fas fa-shopping-cart"></i>-->
<!--                </button>-->
<!--            </div>-->
        </div>
    </div>
</template>

<script>
import router from "../../../router";

export default {
    name: "CardComponent",
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    methods: {
        wishlist(product, toggle) {
            this.$store.dispatch("frontendWishlist/toggle", {
                product_id: product.id,
                toggle: toggle
            }).then((res) => {
            }).catch((err) => {
                if (err.response.status === 401) {
                    product.wishlist = false;
                    router.push({ name: "auth.login" });
                }
            });
        },
        buyProduct(product) {
            // Implement buy product functionality
        },
        virtualTry(product) {
            // Implement virtual try functionality
        },
        getLocalized(nameData) {
            const language = this.$i18n.locale || 'en';
            if (nameData != null) {
                return nameData[language] || nameData['en'];
            }
            return '';
        }
    }
}
</script>
<style scoped>
@media (max-width: 639px) {
    .product{
        height: 268px !important;
        width: 175px !important;
    }
    .mean_image{
        height: 268px !important;
        width: 175px !important;
    }
    .sise{
        font-size: 13px;
    }
    .price{
        column-gap: 3.25rem;
    }
    .fint{
        font-size: 15px;
    }
    .emg{
        width: 100%!important;
        height:3rem!important;

    }
}
</style>
