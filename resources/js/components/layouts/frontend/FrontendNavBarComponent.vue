<template>

    <header :class="isSticky === true ? 'fixed top-0 left-0 z-30 w-full mb-2 sm:mb-8 shadow-xs bg-white' : 'sm:mb-5 shadow-xs bg-white'">
        <div class="container py-3.5 px-4 lg:py-3">
            <div class="gaping flex items-center justify-between gap-5">
                <div class="flex items-center justify-between gap-5">
                    <!-- Card Button Start -->
                    <button @click.prevent="showTarget('cart-canvas', 'canvas-active')" type="button"
                            class="hidden lg:block flex-shrink-0 relative">
                        {{ $t('label.cart') }}
                        <i class="lab-line-bag text-xl w-10 h-10 !leading-10 text-center rounded-full bg-secondary text-white"></i>
<!--                        <span v-if="carts.length > 0" class="absolute top-4 ltr:right-1 rtl:left-1 text-[10px] font-medium h-4 px-1 leading-[14px] text-center rounded-full border border-heading text-white bg-primary">-->
<!--                        {{ carts.length }}-->
<!--                    </span>-->
                    </button>
                    <!-- Card Button End -->
                    <!-- Wishlist Start -->
                    <router-link class="hidden lg:block relative" :to="{ name: 'frontend.wishlist' }">
                          {{ $t('label.Favorites') }}
                        <i class="lab-line-heart text-xl"></i>
                        <span v-if="wishlists.length > 0" class="absolute top-2 ltr:-right-2 rtl:-left-2 text-[10px] font-medium h-4 px-1 !leading-[14px] text-center rounded-full border border-white text-white bg-primary">
                        {{ wishlists.length }}
                    </span>
                    </router-link>
                    <!-- WishList End -->

                    <!-- My Account Start -->
                    <div class="relative hidden lg:block group">
                          {{ $t('label.account') }}
                        <button type="button" class="lab-line-user text-xl py-5"></button>
                        <div v-if="logged" class="w-60 absolute top-15 -right-10 z-10 rounded-2xl overflow-hidden shadow-card bg-white transition-all duration-300 origin-top scale-y-0 group-hover:scale-y-100">
                            <div class="flex items-center gap-3 p-4 border-b border-[#EFF0F6]">
                                <img :src="profile.image" alt="avatar"
                                     class="w-11 h-11 rounded-full object-cover flex-shrink-0" loading="lazy" >
                                <dl class="w-full">
                                    <dt class="font-semibold capitalize whitespace-nowrap mb-0.5">
                                        {{ textShortener(profile.name, 20) }}
                                    </dt>
                                    <dd class="text-sm font-medium whitespace-nowrap text-text" v-if="profile.phone">
                                        {{ profile.country_code }}{{ profile.phone }}
                                    </dd>
                                </dl>
                            </div>
                            <nav class="flex flex-col py-2">
                                <router-link v-if="profile.role_id !== enums.roleEnum.CUSTOMER && Object.keys(authDefaultPermission).length > 0"
                                             class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                             :to="{ name: 'admin.dashboard' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-dashboard"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.dashboard') }}
                                                </span>
                                </router-link>

                                <router-link
                                    class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                    :to="{ name: 'frontend.account.orderHistory' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-bag"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.order_history') }}
                                                </span>
                                </router-link>

                                <router-link
                                    class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                    :to="{ name: 'frontend.account.returnOrders' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-refresh"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.return_orders') }}
                                                </span>
                                </router-link>

                                <router-link
                                    class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                    :to="{ name: 'frontend.account.accountInfo' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-user"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.account_info') }}
                                                </span>
                                </router-link>

                                <router-link
                                    class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                    :to="{ name: 'frontend.account.changePassword' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-key"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.change_password') }}
                                                </span>
                                </router-link>

                                <router-link
                                    class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100"
                                    :to="{ name: 'frontend.account.address' }">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-location"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                                    {{ $t('menu.address') }}
                                                </span>
                                </router-link>

                                <button @click.prevent="logout()" class="flex items-center gap-3 px-4 py-2 transition-all duration-500 hover:bg-gray-100">
                                    <i class="text-sm text-[#A0A3BD] lab-fill-logout"></i>
                                    <span class="text-sm font-medium capitalize whitespace-nowrap">
                                    {{ $t('button.logout') }}
                                </span>
                                </button>
                            </nav>
                        </div>

                        <div v-else class="w-64 absolute top-15 -right-10 z-10 p-4 rounded-2xl overflow-hidden shadow-card bg-white transition-all duration-300 origin-top scale-y-0 group-hover:scale-y-100">
                            <router-link class="!text-primary !bg-[#FFF4F1] w-full text-center h-12 leading-12 font-semibold tracking-wide rounded-full whitespace-nowrap" :to="{ name: 'auth.signup' }">
                                {{ $t('button.register_your_account') }}
                            </router-link>
                            <span class="block font-medium uppercase text-center py-3">{{ $t('label.or') }}</span>
                            <router-link class="w-full text-center h-12 leading-12 font-semibold tracking-wide rounded-full whitespace-nowrap text-white bg-primary" :to="{ name: 'auth.login' }">
                                {{ $t('button.login_to_your_account') }}
                            </router-link>
                        </div>
                    </div>
                    <!-- My Account End -->
                </div>

                <!-- Language Start -->
                <div class="relative group hidden lg:block">
                    <button type="button" class="flex items-center gap-2 py-5"
                            @click.prevent="changeLanguage(language.id, language.code)">
                        <span class="font-semibold capitalize">Language</span>
                    </button>
                </div>
                <!-- Language End -->


                <!--                &lt;!&ndash; Language Start &ndash;&gt;-->
                <!--                <div v-if="setting.site_language_switch === enums.activityEnum.ENABLE"-->
                <!--                     class="relative group hidden lg:block">-->
                <!--                    <button type="button" class="flex items-center gap-2 py-5 down-arrow">-->
                <!--                        <img :src="language.image" alt="language" class="w-4 h-4 rounded-full" loading="lazy" />-->
                <!--                        <span class="font-semibold capitalize">{{ language.name }}</span>-->
                <!--                    </button>-->

                <!--                    <ul class="w-40 absolute top-16 ltr:right-0 rtl:left-0 shadow-paper rounded-lg z-10 p-2 bg-white transition-all duration-300 origin-top scale-y-0 group-hover:scale-y-100">-->
                <!--                        <li v-for="(LoopLanguage, index) in languages" :key="index"-->
                <!--                            @click.prevent="changeLanguage(LoopLanguage.id, LoopLanguage.code)"-->
                <!--                            class="flex items-center gap-3 px-2 py-1.5 rounded-lg relative w-full cursor-pointer transition-all duration-300 hover:bg-slate-100">-->
                <!--                            <img :src="LoopLanguage.image" alt="flags" class="w-4 flex-shrink-0" loading="lazy" />-->
                <!--                            <span class="text-sm font-medium capitalize flex-auto">{{ LoopLanguage.name }}</span>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--                &lt;!&ndash; Language End &ndash;&gt;-->


                <!--  Logo & Mobile Responsive Start -->
                <div class="flex items-center justify-between gap-15">
                <div class="flex items-center flex-shrink-0 gap-5">
                    <button type="button" class="leading-none block lg:hidden"
                            @click.prevent="showTarget('mobile-sidebar-canvas', 'canvas-active')">
                        <i class="lab-line-humburger text-xl"></i>
                    </button>
                    <button type="button" class="leading-none block lg:hidden"
                            @click.prevent="showTarget('search', 'search-active')">
                        <i class="lab-line-search text-xl"></i>
                    </button>
                </div>
                    <div class="flex items-center flex-shrink-0 gap-5">
                <router-link :to="{ name: 'frontend.home' }"
                             class="router-link-active router-link-exact-active flex-shrink-0">
                    <img class=" logom w-28 sm\:h-17" src="/logo.png" alt="logo" loading="lazy" style="width: 184px; height: 45px;" />
                </router-link>
                    </div>
                    <div class="flex items-center flex-shrink-0 gap-5">
                <router-link class="relative lg:hidden" :to="{ name: 'frontend.wishlist' }">
                    <i class="lab-line-heart text-xl"></i>
                    <span v-if="wishlists.length > 0" class="absolute top-2 ltr:-right-2 rtl:-left-2 text-[10px] font-medium h-4 px-1 !leading-[14px] text-center rounded-full border border-white text-white bg-primary">
                        {{ wishlists.length }}
                    </span>
                </router-link>
                <div class="relative lg:hidden">
                    <button type="button" class="lab-line-user text-xl py-5"></button>
                </div>
                <button @click.prevent="showTarget('cart-canvas', 'canvas-active')" type="button"
                        class="lg:hidden flex-shrink-0 relative">
                    <i class="lab-line-bag text-xl w-7 h-10 !leading-10 text-center rounded-full bg-secondary text-white"></i>
                </button>
                    </div>
                </div>
                <!--  Logo & Mobile Responsive End -->
                <!-- Mobile Search Start -->
                <form @submit.prevent="search" class="hidden w-full h-10 lg:flex items-center gap-2 px-4 border border-gray-100 bg-gray-100 transition-all duration-300 focus-within:bg-white" style="width: 346px; height: 44px;direction: rtl">
                    <button class="lab-line-search text-lg flex-shrink-0"></button>
                    <input v-model="searchProduct" class="w-full h-full" type="search" :placeholder="searchPlaceholder" />
<!--                           :placeholder="$t('label.search') + '...'"-->

                </form>
                <!-- Mobile Search Start -->
            </div>
        </div>
    </header>

    <!-- Mobile Search Start -->
    <div id="search" class="w-full  lg:w-auto fixed inset-0 z-30 py-5 px-4 bg-white transition-all duration-500 origin-top scale-y-0">
        <div class="flex items-center justify-between mb-4">
            <router-link :to="{ name: 'frontend.home' }" class="router-link-active router-link-exact-active flex-shrink-0">
                <img class="w-28 sm:w-32" :src="setting.theme_logo" alt="logo" loading="lazy">
            </router-link>
            <button type="button">
                <i @click.prevent="hideTarget('search', 'search-active')" class="lab-line-circle-cross text-xl" ></i>
            </button>
        </div>
        <div class="w-full h-10 rounded-3xl flex items-center gap-2 px-4 mb-4 bg-gray transition-all duration-300 focus-within:border-primary focus-within:bg-white">
            <button class="lab-line-search text-lg flex-shrink-0"></button>
            <input id="searchSomething" v-model="searchProduct" @keyup="searchElement" class="w-full h-full" type="search" :placeholder="searchPlaceholder">
        </div>
        <div class="lg:hidden h-[calc(100vh_-_140px)] rounded-xl overflow-y-auto p-4 bg-gray-100">
            <ul v-if="searchProductLists.length > 0" id="searchProductLists">
                <li :key="searchProductList.name" class="py-1 hover:px-2 whitespace-nowrap overflow-hidden text-ellipsis rounded-lg transition-all duration-300 hover:bg-white hover:text-primary" @click.prevent="goSearchProduct(searchProductList.slug)" v-for="searchProductList in searchProductLists">{{ searchProductList.name }}</li>
            </ul>
        </div>
    </div>
    <!-- Mobile Search End -->

    <!-- Notification Start -->
    <div id="order-modal" v-if="orderNotificationStatus" ref="orderNotificationModal" class="modal active ff-modal">
        <div class="modal-dialog max-w-[360px] p-6 text-center relative">
            <button @click.prevent="closeOrderNotificationModal('order-modal', 'modal-active')" class="modal-close absolute top-4 right-4">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
            <h3 class="text-[18px] font-semibold leading-8 mb-6">
                {{ orderNotificationMessage }}
                <span class="block">{{ $t('message.please_check_your_order_list') }}</span>
            </h3>
            <router-link :to="{ path: '/admin/' + orderNotification.url }" class="db-btn h-[38px] shadow-[0px_6px_10px_rgba(255,_0,_107,_0.24)] bg-primary text-white">
                {{ $t('button.let_me_check')}}
            </router-link>
        </div>
    </div>
    <!-- Notification End -->

</template>

<script>
import statusEnum from "../../../enums/modules/statusEnum";
import {onMounted, ref} from "vue";
import targetService from "../../../services/targetService";
import appService from "../../../services/appService";
import activityEnum from "../../../enums/modules/activityEnum";
import roleEnum from "../../../enums/modules/roleEnum";
import MenuChildrenComponent from "../../frontend/components/MenuChildrenComponent";
import orderTypeEnum from "../../../enums/modules/orderTypeEnum";
import {initializeApp} from "firebase/app";
import {getMessaging, getToken, onMessage} from "firebase/messaging";
import _ from "lodash";
import axios from 'axios';


export default {
    name: "FrontendNavbarComponent",
    components: {MenuChildrenComponent},
    setup() {
        const isSticky = ref();
        onMounted(() => {
            window.addEventListener('scroll', function () {
                let windowScroll = this.scrollY;
                if (windowScroll > 0) {
                    isSticky.value = true;
                } else {
                    isSticky.value = false;
                }
            })
        })
        return {isSticky}
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            searchProductLists : [],
            currentRoute: "",
            defaultLanguage: null,
            enums: {
                activityEnum: activityEnum,
                roleEnum: roleEnum
            },
            languageProps: {
                paginate: 0,
                order_column: "id",
                order_type: "asc",
                status: statusEnum.ACTIVE
            },
            categoryTabStatus: false,
            activeTab: null,
            searchProduct: "",
            orderNotificationStatus: false,
            orderNotificationMessage: "",
            orderNotification: {
                permission: false,
                url: ""
            },
        }
    },
    computed: {
        logged: function () {
            return this.$store.getters.authStatus;
        },
        authDefaultPermission: function () {
            return this.$store.getters.authDefaultPermission;
        },
        profile: function () {
            return this.$store.getters.authInfo;
        },
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        language: function () {
            const allLanguages = this.$store.getters['frontendLanguage/lists'];
            const language = this.$store.getters['frontendLanguage/show'];
            let res;
            res = allLanguages.filter(function (lang) {
                return lang.code !== language.code;
            });
            console.log(res);
            return res[0];
        },
        languages: function () {
            return this.$store.getters['frontendLanguage/lists'];
        },
        categories: function () {
            return this.$store.getters['frontendProductCategory/trees'];
        },
        wishlists: function () {
            return this.$store.getters['frontendWishlist/lists'];
        },
        carts: function () {
            return this.$store.getters['frontendCart/lists'];
        },
        searchPlaceholder() {
            return this.$t('label.searchaboutproduct');
        }
    },
    mounted() {
        this.currentRoute     = this.$route.path;
        this.loading.isActive = true;
        this.orderPermissionCheck();
        this.$store.dispatch('frontendSetting/lists').then(res => {
            this.defaultLanguage = res.data.data.site_default_language;
            const globalState    = this.$store.getters['globalState/lists'];
            if (globalState.language_id > 0) {
                this.defaultLanguage = globalState.language_id;
            }

            this.$store.dispatch('frontendLanguage/lists', this.languageProps).then().catch();
            this.$store.dispatch('frontendLanguage/show', this.defaultLanguage).then(res => {
                this.$i18n.locale = res.data.data.code;
                this.$store.dispatch("globalState/init", {
                    language_code: res.data.data.code
                });
            }).catch();

            window.setTimeout(() => {
                this.$store.dispatch('frontendCart/initOrderType', {order_type: orderTypeEnum.DELIVERY});

                if (this.$store.getters.authStatus && res.data.data.notification_fcm_api_key && res.data.data.notification_fcm_auth_domain && res.data.data.notification_fcm_project_id && res.data.data.notification_fcm_storage_bucket && res.data.data.notification_fcm_messaging_sender_id && res.data.data.notification_fcm_app_id && res.data.data.notification_fcm_measurement_id) {
                    initializeApp({
                        apiKey: res.data.data.notification_fcm_api_key,
                        authDomain: res.data.data.notification_fcm_auth_domain,
                        projectId: res.data.data.notification_fcm_project_id,
                        storageBucket: res.data.data.notification_fcm_storage_bucket,
                        messagingSenderId: res.data.data.notification_fcm_messaging_sender_id,
                        appId: res.data.data.notification_fcm_app_id,
                        measurementId: res.data.data.notification_fcm_measurement_id
                    });
                    const messaging = getMessaging();

                    Notification.requestPermission().then((permission) => {
                        if (permission === 'granted') {
                            getToken(messaging, {vapidKey: res.data.data.notification_fcm_public_vapid_key}).then((currentToken) => {
                                if (currentToken) {
                                    axios.post('/frontend/device-token/web', {token: currentToken}).then().catch((error) => {
                                        if (error.response.data.message === 'Unauthenticated.') {
                                            this.$store.dispatch('loginDataReset');
                                        }
                                    });
                                }
                            }).catch();
                        }
                    });

                    onMessage(messaging, (payload) => {
                        const notificationTitle = payload.notification.title;
                        const notificationOptions = {
                            body: payload.notification.body,
                            icon: '/images/required/firebase-logo.png'
                        };
                        new Notification(notificationTitle, notificationOptions);

                        if(payload.data.topicName === 'new-order-found' && this.orderNotification.permission) {
                            this.orderNotificationStatus = true;
                            this.orderNotificationMessage = payload.notification.body;
                            const audio = new Audio(res.data.data.notification_audio);
                            audio.play();
                        }
                    });
                }
            }, 3000);

            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });

        this.loading.isActive = true;
        this.$store.dispatch('frontendProductCategory/trees').then(res => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });

        this.loading.isActive = true;
        this.$store.dispatch("frontendWishlist/lists").then((res) => {
            this.loading.isActive = true;
        }).catch((err) => {
            this.loading.isActive = true;
        });
    },
    methods: {
        showTarget: function (id, cClass) {
            targetService.showTarget(id, cClass);
        },
        hideTarget: function (id, cClass) {
            targetService.hideTarget(id, cClass);
        },
        textShortener: function (text, number = 30) {
            return appService.textShortener(text, number);
        },
        checkIsPathAndRoutePathSame(path) {
            if (this.currentRoute === path) {
                return true;
            }
        },
        changeLanguage: function (id, code) {
            this.defaultLanguage = id;
            this.$store.dispatch("globalState/set", {language_id: id, language_code: code}).then(res => {
                this.$store.dispatch('frontendLanguage/show', id).then(res => {
                    this.$i18n.locale = res.data.data.code;
                }).catch();
            }).catch();
        },
        logout: function () {
            this.$store.dispatch("logout").then(res => {
                this.$router.push({name: "frontend.home"});
            }).catch();
        },
        search: function() {
            if (typeof this.searchProduct !== "undefined" && this.searchProduct !== "") {
                this.$router.push({name: "frontend.product", query: {name: this.searchProduct}});
                this.searchProduct = "";
                this.hideTarget('البحث عن منتج او مصمم', 'search-active')
            }
        },
        orderPermissionCheck: function () {
            const permissions = this.$store.getters.authPermission;
            if (permissions.length > 0) {
                _.forEach(permissions, (permission) => {
                    if (permission.name === 'online-orders') {
                        if (permission.access === true) {
                            this.orderNotification.permission = true;
                            this.orderNotification.url = permission.url;
                        }
                    }
                });
            }
        },
        closeOrderNotificationModal: function (id, cClass) {
            targetService.hideTarget(id, cClass);
            this.orderNotificationStatus = false;
        },
        searchElement: function() {
            if(this.searchProduct && this.searchProduct.length > 2) {
                let url = `frontend/product`;
                url = url + appService.requestHandler({ name : this.searchProduct});
                axios.get(url).then((res) => {
                    this.searchProductLists = res.data.data;
                }).catch();
            } else {
                this.searchProductLists = [];
            }
        },
        goSearchProduct: function(slug) {
            targetService.hideTarget('search', 'search-active');
            this.$router.push({name : 'frontend.product.details', params: { slug: slug }})
        }
    },
    watch: {
        $route(to, from) {
            this.currentRoute = to.path;
        },
    }
}
</script>
<style scoped>
@media (max-width: 639px) {
    .logom{
        width: 72px!important;
        height: 17px!important;
    }
    .gaping{
        gap: 0!important;
        justify-content: normal!important;
    }
}
</style>
