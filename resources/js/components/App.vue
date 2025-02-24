<template>
    <div class="col-8">
        <div class="card mb-4">
            <Question :question="question" :currentTheme="currentTheme" />
        </div>
    </div>
    <div class="col-4">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <div class="card-header-title"><h5>Uskunalar</h5></div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="theme">Choose theme</label>
                    <select id="theme" class="custom-select" v-model="currentThemeId">
                        <option v-for="theme in themes" :key="theme.id" :value="theme.id">{{ theme.name }}</option>
                    </select>
                </div>
                <div class="row mb-2" >
                    <div class="col-6 mb-2">
                        <label for="title-size">Title size</label>
                        <input id="title-size" class="form-control form-control-sm" type="number"
                               v-model="currentTheme.titleSize">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-color">Title color</label>
                        <input id="title-color" class="form-control form-control-sm" type="color"
                               v-model="currentTheme.titleColor">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-align">Title align</label>
                        <select id="title-align" class="custom-select" v-model="currentTheme.titleAlign">
                            <option value="left" :selected="currentTheme.titleAlign === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.titleAlign === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.titleAlign === 'right'">Right</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-align">Title font</label>
                        <select id="title-font" class="custom-select" v-model="currentTheme.titleFont">
                            <option value="Times New Roman" :selected="currentTheme.titleFont === 'Times New Roman'">Times New Roman</option>
                            <option value="Courier New" :selected="currentTheme.titleFont === 'Courier New'">Courier New</option>
                            <option value="Arial Black" :selected="currentTheme.titleFont === 'Arial Black'">Arial Black</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 mb-2" >
                    <div class="col-6 mb-2">
                        <label for="text-size">Text size</label>
                        <input id="text-size" class="form-control form-control-sm" type="number"
                               v-model="currentTheme.textSize">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Text color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color"
                               v-model="currentTheme.textColor">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-align">Text align</label>
                        <select id="text-align" class="custom-select" v-model="currentTheme.textAlign">
                            <option value="left" :selected="currentTheme.textAlign === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.textAlign === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.textAlign === 'right'">Right</option>
                            <option value="justify" :selected="currentTheme.imageAlign === 'justify'">Justify</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-align">Text font</label>
                        <select id="text-font" class="custom-select" v-model="currentTheme.textFont">
                            <option value="Times New Roman" :selected="currentTheme.textFont === 'Times New Roman'">Times New Roman</option>
                            <option value="Courier New" :selected="currentTheme.textFont === 'Courier New'">Courier New</option>
                            <option value="Arial Black" :selected="currentTheme.textFont === 'Arial Black'">Arial Black</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 mb-2" >
                    <div class="col-6 mb-2">
                        <label for="image-align">Image align</label>
                        <select id="image-align" class="custom-select" v-model="currentTheme.imageAlign">
                            <option value="left" :selected="currentTheme.imageAlign === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.imageAlign === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.imageAlign === 'right'">Right</option>

                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="image-size">Image size (%)</label>
                        <input id="image-size" class="form-control form-control-sm" type="number" v-model="currentTheme.imageSize">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Background color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color" v-model="currentTheme.bgColor">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Container color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color" v-model="currentTheme.containerColor">
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">Styles</h4>
                <div class="card-header-btn">
                    <a href="javascript:void(0)" data-toggle="expand" class="btn btn-success"><i class="ion-android-expand"></i></a>
                    <a href="javascript:void(0)" data-toggle="remove" class="btn btn-danger" data-original-title="" title="" data-init="true"><i class="ion-ios-trash-outline"></i></a>
                </div>
            </div>
            <div class="card-body">
                <textarea rows="3" class="form-control" placeholder="CSS styles"></textarea>
            </div>
        </div>
    </div>
</template>

<script>
import Question from "./Question.vue";
const baseUrl = window.location.origin + '/api';

export default {
    components: {
        Question
    },
    data() {
        return {
            question: {
                id: window.location.pathname.split('/').pop(),
                title: '',
                text: null,
                image: null,
                type: null,
                bgImage: null,
                options: null
            },
            themes: null,
            currentThemeId: null,
            currentTheme: {
                name : '',
                titleSize : 16,
                titleColor : '#000000',
                titleAlign : 'left',
                titleFont : 'Times New Roman',
                textSize : 14,
                textColor : '#000000',
                textAlign : 'left',
                textFont : 'Courier New',
                imageAlign : 'center',
                imageSize : 100,
                bgColor : '#ffffff',
                containerColor : '#ffffff',
                optionColor : '#ffffff',
                border : null,
                style : null,
            },
            languages: null,
            error: null,
        }
    },
    watch: {
        currentThemeId() {
            this.currentTheme = this.themes.find((theme) => theme.id === this.currentThemeId);
        },
        error() {
            console.log("Xatolik", this.error);
        }
    },
    created() {
        this.getThemes();
        this.getQuestion(this.question.id);
    },
    mounted() {
    },
    methods: {
        getThemes() {
            axios.get(baseUrl + '/admin/themes/all').then((response) => {
                this.themes = response.data.data;
            }).catch((error) => {
                this.error = error;
            })
        },
        getQuestion(id) {
            axios.get(baseUrl + '/admin/polls/questions/get/' + id).then((response) => {
                this.question.title = response.data.data.title;
                this.question.text = response.data.data.text;
                this.question.image = response.data.data.image;
                this.question.bgImage = response.data.data.bgImage;
                this.question.type = response.data.data.type;
                this.question.options = response.data.data.options;
            }).catch((error) => {
                this.error = error;
            })
        }
    }
}
</script>

<style scoped>

</style>
