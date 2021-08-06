<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> Blogs </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addBlogModal"> Create New Blog </button>
                </div>
                <div class="table-report mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Title </th>
                            <th scope="col"> Author's Name </th>
                            <th scope="col"> Published Date </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(blog, index) in all_blogs" :key="index">
                            <td class="text-center"> {{ blog.title }} </td>
                            <td class="text-center"> {{ blog.author_name }} </td>
                            <td class="text-center"> {{ formatDate(blog.date_published) }} </td>
                            <td class="text-center"> 
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editBlogModal" @click="getBlogContent(blog)"><i class="far fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" @click="deleteBlog(blog)"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Blog Modal -->
        <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="addBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add New Blog </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="saveBlog">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Blog Title </label>
                                        <input type="text" v-model="form.title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Author's Name </label>
                                        <input type="text" v-model="form.author_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Date Published </label>
                                        <v-date-picker
                                            v-model="form.date_published"
                                            :masks="masks"
                                            color="blue"
                                            is-dark
                                            class="mt-1"
                                        >
                                            <template v-slot="{ inputValue, inputEvents }">
                                                <div class="form-group">
                                                    <input
                                                        :value="inputValue"
                                                        v-on="inputEvents"
                                                        class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                                        required
                                                    />
                                                </div>
                                            </template>
                                        </v-date-picker>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Image File </label>
                                        <input type="file" class="form-control" name="blog_file" id="blog_file_id" accept=".jpeg, .jpg, .png" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="font-weight-bold"> Content </label>
                                <div v-for="(con, counter) in content" :key="counter" class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label style="text-indent: 10px"> Paragraph {{counter+1}} </label>
                                        <button 
                                            type="btn" 
                                            class="btn btn-sm btn-danger" 
                                            @click="deleteParagraph(counter)"
                                            v-if="counter != 0"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>                                
                                    <textarea class="form-control" v-model="con.paragraph" required></textarea>
                                </div>
                                <div class="text-center"> 
                                    <button type="btn" class="btn btn-success mt-2" @click="addParagraph"> Add Another Paragraph </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Blog Modal -->
        <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBlogModalLabel"> Edit - <span class="font-weight-bold">{{ edit_blog.title }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateBlog">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Blog Title </label>
                                        <input type="text" v-model="form.title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Author's Name </label>
                                        <input type="text" v-model="form.author_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Date Published </label>
                                        <v-date-picker
                                            v-model="form.date_published"
                                            :masks="masks"
                                            color="blue"
                                            is-dark
                                            class="mt-1"
                                        >
                                            <template v-slot="{ inputValue, inputEvents }">
                                                <div class="form-group">
                                                    <input
                                                        :value="inputValue"
                                                        v-on="inputEvents"
                                                        class="border p-2 rounded focus:outline-none focus:border-indigo-300 form-control"
                                                        required
                                                    />
                                                </div>
                                            </template>
                                        </v-date-picker>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="font-weight-bold"> Content </label>
                                <div v-for="(con, counter) in content" :key="counter" class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <label style="text-indent: 10px"> Paragraph {{counter+1}} </label>
                                        <button 
                                            type="btn" 
                                            class="btn btn-sm btn-danger" 
                                            @click="deleteParagraph(counter)"
                                            v-if="counter != 0"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>                                
                                    <textarea class="form-control" v-model="con.paragraph" required></textarea>
                                </div>
                                <div class="text-center"> 
                                    <button type="btn" class="btn btn-success mt-2" @click="addParagraph"> Add Another Paragraph </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['auth'],
    data() {
        return {
            all_blogs: [],
            edit_blog: [],
            form: {
                title: '',
                author_name: '',
                date_published: '',
                image: '',
            },
            content: [{
                paragraph: '',
            }],
            masks: {
                input: 'MMM DD YYYY',
            },
        }
    },
    mounted() {
        this.getAllBlog();
    },
    methods: {
        getBlogContent(blog) {
            this.edit_blog = blog;
            this.form.title = blog.title;
            this.form.author_name = blog.author_name;
            this.form.date_published = blog.date_published;
        },
        deleteBlog(blog) {
            Swal.fire({
                title: 'Delete Blog?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/blogs/delete', {
                        id: blog.id
                    }).then(response => {
                        Swal.fire(
                            'Success!',
                            'Blog is deleted.',
                            'success'
                        )
                        this.getAllBlog();
                    })
                }
            });
        },
        saveBlog() {
            Swal.fire({
                title: 'Save Blog?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()
                    var file = document.querySelector('#blog_file_id');

                    formData.append('blog_file', file.files[0]);
                    formData.append('title', this.form.title);
                    formData.append('author_name', this.form.author_name);
                    formData.append('date_published', moment(this.form.date_published).format('YYYY-MM-DD'));
                    formData.append('content', JSON.stringify(this.content));

                    axios.post('api/blogs/store', formData)
                    .then(response => {
                        if(response.data['message'] === 'Blog is saved.') {
                            this.form.title = '';
                            this.form.author_name = '';
                            this.form.date_published = '';
                            this.content = [
                                { paragraph: '' }
                            ];
                            this.getAllBlog();

                            Swal.fire(
                                'Success!',
                                'Blog is saved.',
                                'success'
                            )
                            $('#addBlogModal').modal('hide')
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Report is not saved.',
                                'error'
                            )
                        }
                    });
                }
            });
        },
        addParagraph() {
            this.content.push({
                paragraph: '',
            })
        },
        deleteParagraph(counter) {
            this.content.splice(counter, 1);
        },
        getAllBlog() {
            axios.get('api/blogs/getAllBlog')
            .then(response => {
                this.all_blogs = response.data;
            });
        },
        formatDate(date){
            return moment(date).format('MMM. DD, YYYY')
        }
    },
}
</script>
