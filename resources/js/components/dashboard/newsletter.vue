<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> CBA Tribune </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addNewsModal"> Add New Newsletter </button>
                </div>
                <div class="table-report mt-4">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th scope="col"> Title </th>
                            <th scope="col"> Published Date </th>
                            <th scope="col"> Image </th>
                            <th scope="col"> Status </th>
                            <th scope="col"> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="n_letter in active_newsletter" :key="n_letter.index">
                                <td class="w-25"> {{ n_letter.title }} </td>
                                <td class="w-20 text-center"> {{ formatDate(n_letter.date_published) }} </td>
                                <td class="w-15 text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewNewsImageModal" @click="viewImage(n_letter)">View Image</button> 
                                </td>
                                <td class="w-20 text-center font-green" v-if="n_letter.status === 1">Active</td>
                                <td class="w-20 text-center font-red" v-else>Inactive</td>
                                <td class="w-10 text-center">
                                    <button type="button" class="btn btn-success" @click="viewImage(n_letter)" data-toggle="modal" data-target="#editNewsModal"><i class="far fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" @click="deleteNewsletter(n_letter)"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Newsletter Modal -->
        <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Newsletter </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formNews" @submit.prevent="saveNewsletter">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Newsletter Title </label>
                                <input type="text" v-model="form.title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Date Published </label>
                                <v-date-picker
                                    v-model="form.published_date"
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
                                <input type="file" class="form-control" name="image_file[]" id="image_file_id" accept=".jpeg, .jpg, .png" multiple required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Status </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Inactive" value="0" v-model="form.status">
                                    <label class="form-check-label" for="Inactive">Inactive</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Active" value="1" v-model="form.status">
                                    <label class="form-check-label" for="Active">Active</label>
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

        <!-- View Image -->
        <div class="modal fade" id="viewNewsImageModal" tabindex="-1" role="dialog" aria-labelledby="viewNewsImageModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewNewsImageModalLabel"> Newsletter - Image of <span class="font-weight-bold">{{ view_news.title }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="n in view_news.newsletter_images" :key="n.id">
                            <img :src="n.image" alt="Newsletter Image" style="height: 100%; width: 100%;" class="mt-4">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Blog -->
        <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNewsModalLabel"> Edit - <span class="font-weight-bold">{{ view_news.title }}</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" @submit.prevent="editNewsletter">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="font-weight-bold"> Newsletter Title </label>
                                <input type="text" v-model="active_form.title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Date Published </label>
                                <v-date-picker
                                    v-model="active_form.published_date"
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
                                <label class="font-weight-bold"> Status </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="InactiveOpt" value="0" v-model="active_form.status">
                                    <label class="form-check-label" for="InactiveOpt">Inactive</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ActiveOpt" value="1" v-model="active_form.status">
                                    <label class="form-check-label" for="ActiveOpt">Active</label>
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
            view_news: [],
            active_newsletter: [],
            active_form: {
                title: '',
                published_date: '',
                status: 0,
            },
            form: {
                title: '',
                published_date: '',
                status: 0,
            },
            masks: {
                input: 'MMM DD YYYY',
            },

        }
    },
    mounted() {
       this.getNewsletter();
    },
    methods: {
        viewImage(news) {
            this.view_news = news;
            this.fillForm(news)
        },
        fillForm(newsForm) {
            this.active_form.title = newsForm.title;
            this.active_form.published_date = newsForm.date_published;
            this.active_form.status = newsForm.status;
        },
        editNewsletter() {
            Swal.fire({
                title: 'Edit Newsletter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/newsletter/editNewsletter', {
                        id: this.view_news.id,
                        title: this.active_form.title,
                        date_published: moment(this.active_form.published_date).format('YYYY-MM-DD'),
                        status: this.active_form.status
                    }).then(response => {
                        this.active_form = {};
                        document.getElementById("editForm").reset();
                        this.getNewsletter();
                        Swal.fire(
                            'Success!',
                            'Newsletter is updated.',
                            'success'
                        )
                        $('#editNewsModal').modal('hide')
                    })
                }
            });
        },
        saveNewsletter() {
            Swal.fire({
                title: 'Save Newsletter?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()
                    var file = document.querySelector('#image_file_id');
                    let x = 0;

                    for (let x = 0; x < file.files.length; x++) {
                        formData.append('image[]', file.files[x]);
                    }
                    formData.append('title', this.form.title);
                    formData.append('date_published', moment(this.form.published_date).format('YYYY-MM-DD'));
                    formData.append('status', this.form.status);

                    axios.post('api/newsletter/store', formData)
                    .then(response => {
                        if(response.data['message'] === 'Newsletter is saved.') {
                            this.form.title = '';
                            this.form.status = 0;
                            this.form.published_date = '';
                            document.getElementById("formNews").reset();
                            this.getNewsletter();

                            Swal.fire(
                                'Success!',
                                'Newsletter is saved.',
                                'success'
                            )
                            $('#addNewsModal').modal('hide')
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Newsletter is not saved.',
                                'error'
                            )
                        }
                    });
                }
            });
        },
        deleteNewsletter(n) {
            Swal.fire({
                title: 'Delete Newsletter?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/newsletter/delete', {
                        id: n.id
                    }).then(response => {
                        Swal.fire(
                            'Success!',
                            'Newsletter is deleted.',
                            'success'
                        )
                        this.getNewsletter()
                    })
                }
            });
        },
        getNewsletter() {
            axios.get('api/newsletter/getNewsletter')
            .then(response => {
                this.active_newsletter = response.data
            })
        },
        formatDate(date){
            return moment(date).format('MMM. DD, YYYY')
        }
    },
}
</script>
