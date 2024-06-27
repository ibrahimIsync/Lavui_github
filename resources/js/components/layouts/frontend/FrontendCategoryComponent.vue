<template>

    <!-- MenuBar Start -->
    <nav class="header-nav hidden lg:block" style="background: white">
        <ul class="header-nav-list">
            <li class="header-nav-item">
                <div class=" left-0 z-10 w-full origin-top transition-all duration-300">
                    <div class="container">
                        <div class="w-full shadow-paper bg-white">
                            <nav class="w-full flex items-center justify-center">
                                <ul class="flex items-center justify-center">
                                    <li v-for="(category, index) in categories" :key="index">
                                        <router-link
                                            :to="{ name: 'frontend.product', query: { category: category.slug } }"
                                            @mouseover.prevent="activeTab = 'category_' + category.slug"
                                            class="capitalize text-sm font-semibold tracking-wide px-5 py-4 transition-all duration-300 relative before:content-[''] before:absolute before:bottom-0 before:left-0 before:h-0.5 before:bg-primary hover:text-primary"
                                            :class="{ 'text-primary before:w-full before:transition-all before:duration-300': activeTab === 'category_' + category.slug }"
                                        >
                                            {{ getLocalized(category.name) }}
                                        </router-link>
                                    </li>
                                </ul>
                            </nav>
                            <div v-for="category in categories" :key="category.slug">
                                <div v-if="category.children.length > 0"
                                     :class="{'block': activeTab === 'category_' + category.slug, 'hidden': activeTab !== 'category_' + category.slug}"
                                     class="flex items-start gap-5 pb-5 border-t border-gray-200 transition-all duration-300"
                                     @mouseover="activeTab = 'category_' + category.slug"
                                     @mouseleave="activeTab = null">
                                    <div class="w-60 h-80 flex-shrink-0 pt-5 pl-5">
                                        <img class="w-full h-full object-top object-cover rounded-lg"
                                             :src="category.cover" alt="category" loading="lazy" />
                                    </div>
                                    <div class="w-full h-80 thin-scrolling pt-5 pr-5">
                                        <div class="w-full grid gap-5 grid-cols-3">
                                            <div v-for="children in category.children" :key="children.slug" class="self-start">
                                                <h3 class="text-sm font-semibold capitalize pb-3 border-b border-slate-200">
                                                    <router-link
                                                        :to="{ name: 'frontend.product', query: { category: children.slug } }"
                                                        class="hover:text-primary transition-all duration-300">
                                                        {{ children.name }}
                                                    </router-link>
                                                </h3>
                                                <nav v-if="children.children.length > 0" class="flex flex-col mt-2">
                                                    <ul>
                                                        <MenuChildrenComponent :categories="children.children" />
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
        </ul>
    </nav>
    <!-- MenuBar End -->
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
    name: "FrontendCategoryComponent",
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
            return this.$store.getters['frontendLanguage/show'];
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
        getLocalized(nameData) {
            const language = this.$i18n.locale || 'en';
            return nameData[language] || nameData['en'];
        },
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
                this.hideTarget('search', 'search-active')
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
