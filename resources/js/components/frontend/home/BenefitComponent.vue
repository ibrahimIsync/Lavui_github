<template>
    <LoadingComponent :props="loading" />
    <section v-if="benefits.length > 0" class="pt-8 pb-24 sm:py-12 border-t border-slate-100">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" style="direction: rtl;">
                <div v-for="benefit in benefits" :key="benefit.id" class="w-full max-w-[236px] mx-auto sm:mx-0 relative lg:pl-9">
                    <img :src="benefit.thumb" alt="benefit" class="w-6 mb-4 lg:mb-0 lg:absolute lg:top-0 lg:left-0" loading="lazy">
                    <h4 class="text-base font-semibold capitalize mb-2">{{ getLocalized(benefit.title) }}</h4>
                    <p class="text-sm">{{ getLocalized(benefit.description) }}</p>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
    import statusEnum from "../../../enums/modules/statusEnum";
    import LoadingComponent from "../components/LoadingComponent";

    export default {
        name: "BenefitComponent",
        components: {
            LoadingComponent
        },
        data() {
            return {
                loading: {
                    isActive: false,
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
            getLocalized(nameData) {
                const language = this.$i18n.locale || 'en';
                return nameData[language] || nameData['en'];
            }
        }
    }
</script>
<style scoped>
    .container {
        max-width: 100%;
        padding: 0 1rem;
    }

    @media (min-width: 640px) {
        .container {
            max-width: 640px;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 768px;
        }
    }

    @media (min-width: 1024px) {
        .container {
            max-width: 1024px;
        }
    }

    @media (min-width: 1280px) {
        .container {
            max-width: 1280px;
        }
    }
</style>
lg:hidden w-full flex items-center justify-between px-5 py-3 fixed bottom-0 left-0 z-10 shadow-widget bg-white

