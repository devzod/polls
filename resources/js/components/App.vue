<template>
    <div :class="activeQuestion ? 'col-8' : 'col'">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <div class="card-header-title">
                    <h5>{{poll.title}}</h5>
                </div>
                <div class="btn btn-outline-success"><i class="fa fa-plus button-2x"> Добавить question</i></div>
            </div>
            <div class="card-body">
                <Question v-if="!activeQuestion" :questions="poll.questions" />
            </div>
        </div>
    </div>
    <div v-if="activeQuestion" class="col-4">
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
                               v-model="currentTheme.title_size">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-color">Title color</label>
                        <input id="title-color" class="form-control form-control-sm" type="color"
                               v-model="currentTheme.title_color">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-align">Title align</label>
                        <select id="title-align" class="custom-select" v-model="currentTheme.title_align">
                            <option value="left" :selected="currentTheme.title_align === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.title_align === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.title_align === 'right'">Right</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="title-align">Title font</label>
                        <select id="title-font" class="custom-select" v-model="currentTheme.title_font">
                            <option value="Times New Roman" :selected="currentTheme.title_font === 'Times New Roman'">Times New Roman</option>
                            <option value="Courier New" :selected="currentTheme.title_font === 'Courier New'">Courier New</option>
                            <option value="Arial Black" :selected="currentTheme.title_font === 'Arial Black'">Arial Black</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 mb-2" >
                    <div class="col-6 mb-2">
                        <label for="text-size">Text size</label>
                        <input id="text-size" class="form-control form-control-sm" type="number"
                               v-model="currentTheme.text_size">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Text color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color"
                               v-model="currentTheme.text_color">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-align">Text align</label>
                        <select id="text-align" class="custom-select" v-model="currentTheme.text_align">
                            <option value="left" :selected="currentTheme.text_align === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.text_align === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.text_align === 'right'">Right</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-align">Text font</label>
                        <select id="text-font" class="custom-select" v-model="currentTheme.text_font">
                            <option value="Times New Roman" :selected="currentTheme.text_font === 'Times New Roman'">Times New Roman</option>
                            <option value="Courier New" :selected="currentTheme.text_font === 'Courier New'">Courier New</option>
                            <option value="Arial Black" :selected="currentTheme.text_font === 'Arial Black'">Arial Black</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 mb-2" >
                    <div class="col-6 mb-2">
                        <label for="image-align">Image align</label>
                        <select id="image-align" class="custom-select" v-model="currentTheme.image_align">
                            <option value="left" :selected="currentTheme.image_align === 'left'">Left</option>
                            <option value="center" :selected="currentTheme.image_align === 'center'">Center</option>
                            <option value="right" :selected="currentTheme.image_align === 'right'">Right</option>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="image-size">Image size (%)</label>
                        <input id="image-size" class="form-control form-control-sm" type="number" v-model="currentTheme.image_size">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Background color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color" v-model="currentTheme.bg_color">
                    </div>
                    <div class="col-6 mb-2">
                        <label for="text-color">Container color</label>
                        <input id="text-color" class="form-control form-control-sm" type="color" v-model="currentTheme.container_color">
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
            poll: {
                id: window.location.pathname.split('/').pop(),
                title: '',
                text: null,
                questions: null
            },
            themes: null,
            currentThemeId: null,
            activeQuestion: null,
            currentTheme: {
                name : '',
                title_size : 16,
                title_color : '#000000',
                title_align : 'left',
                title_font : 'Times New Roman',
                text_size : 14,
                text_color : '#000000',
                text_align : 'left',
                text_font : 'Courier New',
                image_align : 'center',
                image_size : 100,
                bg_color : '#ffffff',
                container_color : '#ffffff',
                border : null,
                style : null,
            },
            pollId: null,
            languages: null,
            error: null,
        }
    },
    watch: {
        currentThemeId() {
            this.currentTheme = this.themes.find((theme) => theme.id === this.currentThemeId);
        }
    },
    mounted() {
        this.getThemes();
        this.getPoll(this.poll.id);
    },
    methods: {
        getThemes() {
            axios.get(baseUrl + '/admin/themes/all').then((response) => {
                this.themes = response.data.data;
            }).catch((error) => {
                this.error = error;
                console.log('xatolik', error.response.data);
            })
        },
        getPoll(id) {
            axios.get(baseUrl + '/admin/polls/get/' + id).then((response) => {
                this.poll.title = response.data.data.title;
                this.poll.text = response.data.data.text;
                this.poll.questions = response.data.data.questions;
                console.log(this.poll);
            }).catch((error) => {
                this.error = error;
                console.log('xatolik', error.response.data);
            })
        }
    }
}
</script>

<style scoped>

</style>
