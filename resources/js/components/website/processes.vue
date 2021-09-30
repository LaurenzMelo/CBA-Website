<template>
    <div class="other-bg">
        <div class="container mb-5">
            <div class="col-md-10 pt-4">
                <h2 class="font-weight-bold mt-4 color-blue-green mb-4"> Processes </h2>
                <div v-if="all_forms.length === 0" style="min-height: 20vh" />
                <div class="row mb-5 pl-3" v-for="form in all_forms" :key="form.id" v-else>
                    <div v-if="form.process_title !== null">
                        <h5 class="font-weight-bold"> {{ form.process_title }} </h5>
                        <p class="text-indent text-justify form-desc">
                            {{ form.process_description }}
                        </p>
                        <a :href="form.video_file" :download="form.process_title + ' - video'" v-if="form.video_file !== null">
                            <button type="submit" class="btn btn-primary mr-4 mobile-button"> Video Tutorial </button>
                        </a>
                        <a :href="form.audio_file" :download="form.process_title + ' - audio'" v-if="form.audio_file !== null">
                            <button type="button" class="btn btn-primary mr-4 mobile-button"> Audio Tutorial </button>
                        </a>
                        <a :href="form.instruction_file" :download="form.process_title + ' - instruction'" v-if="form.instruction_file !== null">
                            <button type="button" class="btn btn-primary mr-4 mobile-button"> Download {{ form.process_title }} </button>
                        </a>
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
            loop: ["1", "2", "3", "4", "5"],
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
