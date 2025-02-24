<script>
export default {
    props: [
        'question',
        'currentTheme',
    ],
    mounted() {
        console.log('current theme question', this.currentTheme);
    },
}
</script>

<template>
    <div class="p-3 question">
        <div class="question-title">
            <h1 :style="{fontSize: currentTheme.titleSize + 'px', textAlign: currentTheme.titleAlign, color: currentTheme.titleColor,
            fontFamily: currentTheme.titleFont}">{{ question.title }}</h1>
        </div>
        <div class="question-text p-2">
            <p :style="{fontSize: currentTheme.textSize + 'px', textAlign: currentTheme.textAlign, color: currentTheme.textColor,
            fontFamily: currentTheme.textFont}">{{ question.text }}</p>
        </div>
        <div class="question-image">
<!--            <img :src="question.image" alt="">-->
        </div>
        <div class="question-options p-2">
            <ul class="options">
                <li v-for="option in question.options" class="option-item">{{ option.translation.title }}</li>
            </ul>
        </div>

    </div>
</template>

<style scoped>
.question-title {
    padding: 1.5rem;
}

.question-text {
    padding: 1.5rem;
}
.question-image {
    padding: 1rem;
}

</style>
