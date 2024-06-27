<template>
    <div class="container hidden sm:block">
        <div class=" py-10 flex flex-col items-center">
            <h1 class="text-2xl font-semibold text-gray-800 mb-10">
                {{ $t('label.trending') }}
            </h1>
            <div class="flex gap-5">
                <div class="flex flex-col items-center">
                    <img src="/gif1.gif" type="gif" style="width: 454px;height: 656px;object-fit: cover">
                   <CardComponent />
                </div>
                <div class="flex flex-col items-center">
                    <img src="/gif2.gif" type="gif" style="width: 454px;height: 656px;object-fit: cover">
                    <CardComponent />
                </div>
                <div class="flex flex-col items-center">
                    <img src="/gif1.gif" type="gif" style="width: 454px;height: 656px;object-fit: cover">
                    <CardComponent />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CardComponent from "../components/CardComponent.vue";

    export default {
        name: "CategoryComponent",
        components: {CardComponent}
    };
</script>

<style>
    /* Ensure Tailwind is included in your project */
</style>
