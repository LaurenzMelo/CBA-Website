<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-12 pt-4">
                <h2 class="font-weight-bold mt-4 color-blue-green mb-4"> Downloadable Forms </h2>
                <div v-if="all_forms.length === 0" style="min-height: 20vh" />
                <div v-for="form in all_forms" :key="form.id" style="margin-bottom:40px">
                    <div class="row" v-if="form.form_title !== null">
                        <div class="col-md-7">
                            <h5 class="font-weight-bold"> {{ form.form_title }} </h5>
                            <p class="text-indent text-justify form-desc">
                                {{ form.form_description }}    
                            </p>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <div class="nav-red text-center">
                                <h6 class="font-weight-bold pt-1 pb-1" style="color: #FFFFFF"> How to accomplish {{ form.form_title }} </h6>
                            </div>
                            <div> 
                                <a :href="form.instruction_file" :download="form.form_title + ' - instruction'" v-if="form.instruction_file !== null">
                                    How to Accomplish {{ form.form_title }}
                                </a>
                            </div>
                            <div> 
                                <a :href="form.video_file" :download="form.form_title + ' - video'" v-if="form.video_file !== null">
                                    Video Tutorial
                                </a> 
                            </div>
                            <div> 
                                <a :href="form.audio_file" :download="form.form_title + ' - audio'" v-if="form.audio_file !== null">
                                    Audio Tutorial
                                </a>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            all_forms: [],
        }
    },
    mounted() {
        this.getForms();
    },
    methods: {
        getForms() {
            axios.get('//' + window.location.host + '/forms/getForms')
            .then(response => {
                this.all_forms = response.data
            })
        },
    }
}
</script>
