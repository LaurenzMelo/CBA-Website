<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <button type="btn" class="btn btn-secondary" @click="goBack"> Go Back </button>
                <div class="container mt-5">
                    <h4 class="font-weight-bold"><i> {{ blog.title }} </i></h4>
                    <h6> {{ blog.author_name }} </h6>
                    <h6 class="mb-4"> Published {{ formatDate(blog.date_published) }} </h6>
                    <img :src="image" class="parallax">
                    <p class="text-justify text-indent mt-4 mb-2" v-for="(con, index) in content" :key="index">
                        {{ con.paragraph }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ind_blog'],
        data() {
            return {
                blog: this.ind_blog,
                content: [],
                image: process.env.MIX_VUE_URL + this.ind_blog.image,
            }
        },
        mounted() {
            this.changeContent();
        },
        methods: {
            goBack() {
                location.replace('/blog');
            },
            changeContent() {
                this.content = JSON.parse(this.blog.content)
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
