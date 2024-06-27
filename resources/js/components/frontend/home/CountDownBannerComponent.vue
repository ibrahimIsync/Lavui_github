<template>
    <LoadingComponent :props="loading" />
    <section v-if="benefits.length > 0" class="pt-8 pb-24 sm:py-12 border-t border-slate-100">
        <div class="container">
            <div style="height: 400px; display: flex; justify-content: space-between;position: relative;">
                <figure style="height: 100%;">
                    <img class="w-full rounded-xl d-block" style="height: 100%;" src="/count.png" alt="banner" loading="lazy">
                </figure>
                <div id="count" style="background-color: rgb(85, 60, 154);
    color: rgb(255, 255, 255);
    position: absolute;
    top: 56%;
    left: 86px;
    font-size: 30px;
    border-radius: 2px;
    width: 235px;
    height: 70px;
    text-align: center;
    line-height: 70px;
    font-family: cursive;">
                    <p>{{ hours }} : {{ minutes }} : {{ seconds }}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
<!--


                here must for loop (product has offers only.)



-->
<!--                <div v-for="benefit in benefits" class="w-full max-w-[236px] relative lg:pl-9">-->
<!--                    <img :src="benefit.thumb" alt="benefit" class="w-6 mb-4 lg:mb-0 lg:absolute lg:top-0 lg:left-0" loading="lazy">-->
<!--                    <h4 class="text-base font-semibold capitalize mb-2">{{ benefit.title }}</h4>-->
<!--                    <p class="text-sm">{{ benefit.description }}</p>-->
<!--                </div>-->
            </div>
        </div>
    </section>
</template>

<!--<script>-->
<!--import statusEnum from "../../../enums/modules/statusEnum";-->
<!--import LoadingComponent from "../components/LoadingComponent";-->

<!--export default {-->
<!--    name: "CountDownBannerComponent",-->
<!--    components: {-->
<!--        LoadingComponent-->
<!--    },-->
<!--    data() {-->
<!--        return {-->
<!--            loading: {-->
<!--                isActive: false,-->
<!--            }-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        benefits: function () {-->
<!--            return this.$store.getters["frontendBenefit/lists"];-->
<!--        },-->
<!--    },-->
<!--    mounted() {-->
<!--        this.loading.isActive = true;-->
<!--        this.$store.dispatch("frontendBenefit/lists", {-->
<!--            paginate: 0,-->
<!--            order_column: "id",-->
<!--            order_type: "asc",-->
<!--            status: statusEnum.ACTIVE,-->
<!--        }).then(res => {-->
<!--            this.loading.isActive = false;-->
<!--        }).catch((err) => {-->
<!--            this.loading.isActive = false;-->
<!--        });-->
<!--    }-->
<!--}-->
<!--</script>-->

<script>
import statusEnum from "../../../enums/modules/statusEnum";
import LoadingComponent from "../components/LoadingComponent";

export default {
    name: "CountDownBannerComponent",
    components: {
        LoadingComponent
    },
    data() {
        return {
            loading: {
                isActive: false,
            },
            expireDate: '2024-06-15T00:00:00', // Set your expiry date here
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0
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

        // Calculate time left immediately and every second
        this.calculateTimeLeft();
        setInterval(this.calculateTimeLeft, 1000);
    },
    methods: {
        calculateTimeLeft() {
            const currentTime = new Date();
            const expireTime = new Date(this.expireDate);
            const difference = expireTime - currentTime;

            if (difference > 0) {
                this.days = Math.floor(difference / (1000 * 60 * 60 * 24));
                this.hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                this.minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                this.seconds = Math.floor((difference % (1000 * 60)) / 1000);

                // Format hours, minutes, and seconds to always display two digits
                this.hours = this.formatNumber(this.hours);
                this.minutes = this.formatNumber(this.minutes);
                this.seconds = this.formatNumber(this.seconds);
            } else {
                this.days = 0;
                this.hours = "00";
                this.minutes = "00";
                this.seconds = "00";
            }
        },
        formatNumber(number) {
            return number < 10 ? '0' + number : number;
        }
    }
}
</script>
