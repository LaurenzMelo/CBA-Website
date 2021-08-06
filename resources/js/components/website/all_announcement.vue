<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <button type="button" class="btn btn-secondary" @click="goBack"> Go Back </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['all'],
        data() {
            return {
                announcement: this.all,
            }
        },
        mounted() {
            console.log(this.announcement)
        },
        methods: {
            goBack() {
                location.replace('/');
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
