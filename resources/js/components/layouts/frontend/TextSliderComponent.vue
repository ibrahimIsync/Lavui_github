<template>
    <div class="container">
        <div class="slider container sm:mb-5 ">
            <div class="slider-inner animate-marquee" ref="sliderInner">
                {{ repeatedText }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TextSliderComponent',
    data() {
        return {
            text: 'خصم 50% علي اي نضاره شمسيه',
            repeatedText: '',
            direction: 1,
            distance: 0
        };
    },
    mounted() {
        this.initializeText();
        this.$nextTick(() => {
            this.setDistance();
            this.moveText();
        });
    },
    methods: {
        initializeText() {
            const space = '\u00A0'.repeat(20); // 20 non-breaking spaces for spacing
            this.repeatedText = new Array(10).fill(this.text).join(space); // Repeat the text 10 times
        },
        setDistance() {
            this.distance = this.$refs.sliderInner.scrollWidth / 5;
        },
        moveText() {
            if (this.$refs.sliderInner) {
                this.$refs.sliderInner.style.transform = `translateX(${this.direction * -this.distance}px)`;
                setTimeout(() => {
                    this.direction *= -1; // Reverse direction
                    this.moveText(); // Call the function recursively
                }, 5000); // Wait for 5 seconds before reversing direction
            }
        }
    }
};
</script>
<style scoped>
.slider {
    width: 100%;
    height: 48px;
    overflow: hidden;
    white-space: nowrap;
    background-color: #553C9A;
    color: #fff;
    font-size: 13px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.slider-inner {
    display: inline-block;
    transition: transform 5s linear;
    will-change: transform;
;}
</style>

