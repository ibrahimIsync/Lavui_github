<template>
    <LoadingComponent :props="loading" />
    <section v-if="benefits.length > 0" class="hes pt-8 pb-24 sm:py-12 border-t border-slate-100">
        <div class="container" style="position: relative;background:rgb(246 245 243);height: 390px">
           <div class="row">
               <div class="sise col-4 md:col-4 lg:col-4">
                   <img class="sise w-full" src="/subscripe.jpg" alt="subscripe" style="height: 390px;object-fit: cover">
               </div>
               <div class="ses col-8 md:col-8 lg:col-8">
                   <h2>هل تحتاج مساعدة؟</h2>
                   <br>
                   <p>لأي استفسار يرجى التحدث الي خدمة العملاء عبر رقم / 000000000000</p>
                   <form @submit.prevent="saveSubscription" style="width:415px;display: inline-block;direction: rtl" class="mt-5 mb-6" >
<!--                       <h2 style="font-size: 19px; ">{{ $t('label.subscribetothenewsletter') }}</h2>-->
                       <br>
                       <div class="w-full h-10 bg-white flex">
                           <input style="margin-bottom: 19px;" type="email" v-model="subscriptionProps.post.email" :placeholder="insertYourEmail"
                                  class="w-full h-full pl-3 pr-2">
                           <!--                               :placeholder="$t('label.your_email_address')"-->

                           <button type="submit" style="background-color:#4C338C; color: white;"
                                   class="text-xs font-semibold capitalize px-3 h-full text-white">
                               <!--                            {{ $t('button.subscribe') }}-->
                               ارسال
                           </button>
                       </div>
                   </form>
               </div>

           </div>
        </div>
    </section>
</template>

<script>
import statusEnum from "../../../enums/modules/statusEnum";
import LoadingComponent from "../components/LoadingComponent";
import axios from "axios";
import alertService from "../../../services/alertService";
import DefaultComponent from "../../DefaultComponent.vue";

export default {
    name: "SubscriptionBannerComponent",
    components: {
        DefaultComponent,
        LoadingComponent
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            subscriptionProps: {
                post: {
                    email: ""
                }
            }
        }
    },
    computed: {
        benefits: function () {
            return this.$store.getters["frontendBenefit/lists"];
        },
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch("frontendBenefit/lists", {
            paginate: 0,
            order_column: "id",
            order_type: "asc",
            status: statusEnum.ACTIVE,
        }).then(res => {
            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
    },
    methods: {
        saveSubscription: function () {
            const url = '/frontend/subscriber';
            this.loading.isActive = true;
            axios.post(url, this.subscriptionProps.post).then(res => {
                this.loading.isActive = false;
                this.subscriptionProps.post.email = "";
                alertService.success(this.$t("message.subscribe"));
            }).catch((err) => {
                this.loading.isActive = false;
            });
        }
    }
}
</script>
<style scoped>
    .ses{
        text-align: center;
        position: relative;
        transform: translateY(18%);
    }
    @media (max-width: 639px) {
        .container{
            height:179px!important;
        }
        .row{
            gap: 1.25rem!important;
        }
        .ses{
            display: flex!important;
            align-items: center!important;
            justify-content: center!important;
            flex-wrap: wrap!important;
            width:229px!important;
            height:109px!important;
            top: 50%!important;
        }
        .sise{
            height: 129px!important;
            width: 162px;
        }
        .hes{
            height: 179px;
        }
    }
</style>
