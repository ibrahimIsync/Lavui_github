<template>
    <dl class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-6">
        <dd class="flex flex-wrap items-center gap-3">
            <p><i class="fa-solid fa-gift"></i>احصل علي 1200 نقطة ولاء </p>
        </dd>
        <dd class="flex flex-wrap items-center gap-3">
            <p><i class="fa-solid fa-award"></i>  هذا المنتج اصلي100 %</p>
        </dd>

    </dl>

    <VariationComponent :method="getFinalVariationId" :key="selectedVariations" v-if="selectedVariations.length > 0" :variations="selectedVariations" />

</template>

<script>

export default {
    name : "VariationComponent",
    props: {
        "variations": {type: Object},
        "method": {type : Function}
    },
    data() {
        return {
            selectedVariationId : null,
            selectedVariations : [],
            finalSelectedVariation: null
        }
    },
    methods: {
        selectVariation: function(variation) {
            this.selectedVariationId = variation.id;

            if(!variation.sku) {
                this.finalSelectedVariation = null;
                this.getFinalVariationId(this.finalSelectedVariation);
            } else {
                this.finalSelectedVariation = variation;
                this.getFinalVariationId(this.finalSelectedVariation);
            }

            this.$store.dispatch("frontendProductVariation/childrenVariation", this.selectedVariationId).then((res) => {
                this.selectedVariations = res.data.data;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        getFinalVariationId: function(id) {
            this.method(id);
        }
    }
}
</script>
