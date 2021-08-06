<template>
    <div class="other-bg">
        <div class="container-fluid mb-5">
            <div class="col-md-12 pt-4">
                <div class="row">
                    <div class="col-md-8 shadow pt-4 border p-5">
                        <h1 class="font-weight-bold text-center color-yellow font-avenir mb-4"> BLOGSPOT: YOUR STORY TO TELL</h1>
                        <div v-if="featured_blog.length === 0" class="text-center"> 
                            <h6> As of the moment, our blog page is empty. </h6>
                        </div>
                        <div v-else>
                            <h4 class="font-weight-bold"><i> {{ featured_blog.title }} </i></h4>
                            <h6> {{ featured_blog.author_name }} </h6>
                            <h6 class="mb-4"> Published {{ formatDate(featured_blog.date_published) }} </h6>
                            <img :src="featured_blog.image" class="parallax">
                            <p class="text-justify text-indent mt-4 mb-2" v-for="(content, index) in contents" :key="index">
                                {{ content.paragraph }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 pt-4 p-5">
                        <h4 class="font-weight-bold"> Other Blogs: </h4>
                        <hr class="m-0 hr-15">
                        <div v-for="(blog, index) in side_blogs" class="ml-4 mt-4" :key="index">
                            <a :href="'/blog/' + blog.id"><h6 class="font-weight-bold mb-1 color-red">{{ blog.title }}</h6></a>
                            <h6 class="mb-0"> {{ blog.author_name }} </h6>
                            <h6 class="mb-4 pt-0"> Published {{ formatDate(blog.date_published) }} </h6>
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
                featured_blog: '',
                side_blogs: [],
                contents: [],
            }
        },
        mounted() {
            this.getBlog();
        },
        methods: {
            getBlog() {
                axios.get('//' + window.location.host + '/blog/getBlog')
                .then(response => {
                    this.featured_blog = response.data.featured_blog;
                    this.side_blogs = response.data.side_blogs;
                    this.contents = JSON.parse(this.featured_blog.content)
                })
            },
            formatDate(date){
                return moment(date).format('MMM. DD, YYYY')
            }
        }
    }
</script>
