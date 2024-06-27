<template>

    <SliderComponent />

<!--    <div>-->
<!--        <form @submit.prevent="createPayment">-->
<!--            &lt;!&ndash; Collect necessary order details &ndash;&gt;-->
<!--            &lt;!&ndash; Example fields, replace with actual fields you need &ndash;&gt;-->
<!--&lt;!&ndash;            <input v-model="order.total_amount.amount" placeholder="Total Amount">&ndash;&gt;-->
<!--&lt;!&ndash;            <input v-model="order.consumer.email" placeholder="Email">&ndash;&gt;-->
<!--            &lt;!&ndash; Add more fields as needed &ndash;&gt;-->
<!--            <button type="submit">Pay with Tamara</button>-->
<!--        </form>-->
<!--    </div>-->

    <NewArrivalComponent />

    <GeneralBannerComponent />

    <ProductStoryComponent />

    <CategoryComponent />

    <ProductSectionComponent />

    <ProductDiscountComponent />

    <VirtualTryBannerComponent />

    <ProductTrendComponent />

    <ProductBrandComponent />

    <ProductPickedComponent />

    <SubscriptionBannerComponent />

    <BenefitComponent />
</template>

<script>

import SliderComponent from "./SliderComponent.vue";
import CategoryComponent from "./CategoryComponent.vue";
import PromotionComponent from "./PromotionComponent.vue";
import BenefitComponent from "./BenefitComponent.vue";
import ProductSectionComponent from "./ProductSectionComponent.vue";
import FlashSaleComponent from "./FlashSaleComponent.vue";
import ProductBrandComponent from "./ProductBrandComponent.vue";
import MostPopularComponent from "./MostPopularComponent.vue";
import SubscriptionBannerComponent from "./SubscriptionBannerComponent.vue";
import VirtualTryBannerComponent from "./VirtualtryBannerComponent.vue";
import GeneralBannerComponent from "./GeneralBannerComponent.vue";
import CountDownBannerComponent from "./CountDownBannerComponent.vue";
import NewArrivalComponent from "./NewArrivalComponent.vue";
import ProductTrendComponent from "./ProductTrendComponent.vue";
import ProductStoryComponent from "./ProductStoryComponent.vue";
import ProductPickedComponent from "./ProductPickedComponent.vue";
import ProductDiscountComponent from "./ProductDiscountComponent.vue";
import axios from 'axios';

export default {
    name: "HomeComponent",
    components: {
        ProductDiscountComponent,
        ProductPickedComponent,
        ProductStoryComponent,
        ProductTrendComponent,
        NewArrivalComponent,
        CountDownBannerComponent,
        GeneralBannerComponent,
        VirtualTryBannerComponent,
        SubscriptionBannerComponent,
        MostPopularComponent,
        FlashSaleComponent,
        BenefitComponent,
        SliderComponent,
        CategoryComponent,
        PromotionComponent,
        ProductSectionComponent,
        ProductBrandComponent
    },
    methods: {
        async createPayment() {
            try {
                const response = await axios.post('http://localhost:8000/api/create-payment', this.order);

                if (response.data.status === 'success') {
                    window.location.href = response.data.payment_url;
                } else {
                    console.log(response.data);
                    alert('Failed to create payment: ' + response.data.message);
                }
            } catch (error) {
                alert('An error occurred: ' + error.message);
            }
        }
    }
};
</script>
