<template>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pt-5">
        <div class="flex flex-col items-center gap-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-8">
                <!-- Email section -->
                <div class="flex flex-col items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 96" id="email" class="w-16 h-16">
                        <path d="M0 11.283V8a8 8 0 0 1 8-8h112a8 8 0 0 1 8 8v3.283l-64 40zm66.12 48.11a4.004 4.004 0 0 1-4.24 0L0 20.717V88a8 8 0 0 0 8 8h112a8 8 0 0 0 8-8V20.717z"></path>
                    </svg>
                    <div class="text-center">
                        <p class="text-lg font-medium text-black">تحدث مع فريق خدمة العملاء</p>
                        <p class="text-sm text-black">فريق خدمة العملاء متاح للتحدث معك عن طريق WhatsApp</p>
                    </div>
                    <button class="mt-2 px-4 py-2 border border-black rounded-lg">
                        <a href="#"><span class="text-black font-medium text-lg">ارسل البريد الألكتروني</span></a>
                    </button>
                </div>

                <!-- Phone section -->
                <div class="flex flex-col items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="phone" class="w-16 h-16">
                        <path d="M17.4 22A15.42 15.42 0 0 1 2 6.6 4.6 4.6 0 0 1 6.6 2a3.94 3.94 0 0 1 .77.07 3.79 3.79 0 0 1 .72.18 1 1 0 0 1 .65.75l1.37 6a1 1 0 0 1-.26.92c-.13.14-.14.15-1.37.79a9.91 9.91 0 0 0 4.87 4.89c.65-1.24.66-1.25.8-1.38a1 1 0 0 1 .92-.26l6 1.37a1 1 0 0 1 .72.65 4.34 4.34 0 0 1 .19.73 4.77 4.77 0 0 1 .06.76A4.6 4.6 0 0 1 17.4 22z"></path>
                    </svg>
                    <div class="text-center">
                        <p class="text-lg font-medium text-black">تحدث مع فريق خدمة العملاء</p>
                        <p class="text-sm text-black">فريق خدمة العملاء متاح للتحدث معك عن طريق WhatsApp</p>
                    </div>
                    <button class="mt-2 px-4 py-2 border border-black rounded-lg">
                        <a href="#"><span class="text-black font-medium text-lg">اتصل بنا</span></a>
                    </button>
                </div>

                <!-- WhatsApp section -->
                <div class="flex flex-col items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="whatsapp" class="w-16 h-16">
                        <path d="M8.002 0h-.004C3.587 0 0 3.588 0 8a7.94 7.94 0 0 0 1.523 4.689l-.997 2.972 3.075-.983A7.93 7.93 0 0 0 8.002 16C12.413 16 16 12.411 16 8s-3.587-8-7.998-8zm4.655 11.297c-.193.545-.959.997-1.57 1.129-.418.089-.964.16-2.802-.602-2.351-.974-3.865-3.363-3.983-3.518-.113-.155-.95-1.265-.95-2.413s.583-1.707.818-1.947c.193-.197.512-.287.818-.287.099 0 .188.005.268.009.235.01.353.024.508.395.193.465.663 1.613.719 1.731.057.118.114.278.034.433-.075.16-.141.231-.259.367-.118.136-.23.24-.348.386-.108.127-.23.263-.094.498.136.23.606.997 1.298 1.613.893.795 1.617 1.049 1.876 1.157.193.08.423.061.564-.089.179-.193.4-.513.625-.828.16-.226.362-.254.574-.174.216.075 1.359.64 1.594.757.235.118.39.174.447.273.056.099.056.564-.137 1.11z"></path>
                    </svg>
                    <div class="text-center">
                        <p class="text-lg font-medium text-black">تحدث مع فريق خدمة العملاء</p>
                        <p class="text-sm text-black">فريق خدمة العملاء متاح للتحدث معك عن طريق WhatsApp</p>
                    </div>
                    <button class="mt-2 px-4 py-2 border border-black rounded-lg">
                        <a href="#"><span class="text-black font-medium text-lg">ابدأ المحادثة</span></a>
                    </button>
                </div>
            </div>
            <p class="text-lg font-medium text-black text-center mt-8">فريق لافوي متاح للإجابة على جميع أسئلتكم من الساعة الـ 9 صباحاً حتى الساعة 5 مساءاً بتوقيت المملكة العربية السعودية كل يوم باستثناء يوم الجمعة</p>
        </div>
    </div>
</template>


<script>


    import statusEnum from "../../../enums/modules/statusEnum";

    export default {
        name: "ContactUsComponent",
        computed: {
            outlets: function () {
                return this.$store.getters['frontendOutlet/lists'];
            },
            setting: function () {
                return this.$store.getters['frontendSetting/lists'];
            },
        },
        mounted() {
            this.$store.dispatch('frontendOutlet/lists', {order_column: 'id', order_type : 'asc', status : statusEnum.ACTIVE }).then().catch()
        }
    }
</script>
