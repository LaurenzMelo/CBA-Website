<template>
    <div class="col-md-12">
        <div class="card mb-5 mt-2 border shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="font-weight-bold"> Forms & Processes </h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addFormModal"> Create New Forms/Process </button>
                </div>
                <div class="mt-4">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col"> Form Title </th>
                                <th scope="col"> Form Desc </th>
                                <th scope="col"> Process Title </th>
                                <th scope="col"> Process Desc </th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="form in all_forms" :key="form.index">
                                <td v-if="form.form_title !== null" class="w-20"> {{ form.form_title }} </td>
                                <td v-else>-</td>
                                <td v-if="form.form_description !== null" class="w-20"> {{ form.form_description }} </td>
                                <td v-else>-</td>
                                <td v-if="form.process_title !== null" class="w-20"> {{ form.process_title }} </td>
                                <td v-else>-</td>
                                <td v-if="form.process_description !== null" class="w-20"> {{ form.process_description }} </td>
                                <td v-else>-</td>
                                <td class="w-15">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewFormModal" @click="viewForm(form)"><i class="far fa-eye"></i></button>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editFormModal" @click="transferValue(form)"><i class="far fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" @click="deleteForm(form)"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add New Form/Process -->
        <div class="modal fade" id="addFormModal" tabindex="-1" role="dialog" aria-labelledby="addFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFormModalLabel"> Add New Forms/Process </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="saveForm" id="formProcess">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Form Title </label>
                                        <input type="text" class="form-control" v-model="form_title">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Form Description </label>
                                        <textarea rows="2" class="form-control" v-model="form_desc"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Process Title </label>
                                        <input type="text" class="form-control" v-model="process_title">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold"> Process Description </label>
                                        <textarea rows="2" class="form-control" v-model="process_desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Audio File </label>
                                <input type="file" class="form-control" name="audio_file" id="audio_file_id">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Video File </label>
                                <input type="file" class="form-control" name="video_file" id="video_file_id">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold"> Instruction File </label>
                                <input type="file" class="form-control" name="instruction_file" id="instruction_file_id">
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

        <!-- View Processes/Forms -->
        <div class="modal fade" id="viewFormModal" tabindex="-1" role="dialog" aria-labelledby="viewFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewFormModalLabel"><span class="font-weight-bold">View Form/Process</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pl-5 pr-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Form Title </label>
                                    <p class="text-indent" v-if="view_form.form_title != null"> {{ view_form.form_title }} </p> 
                                    <p class="text-indent" v-else> Empty </p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Form Description </label>
                                    <p class="text-indent" v-if="view_form.form_description != null"> {{ view_form.form_description }} </p>
                                    <p class="text-indent" v-else> Empty </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"> Process Title </label>
                                    <p class="text-indent" v-if="view_form.process_title != null"> {{ view_form.process_title }} </p>
                                    <p class="text-indent" v-else> Empty </p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"> Process Description </label>
                                    <p class="text-indent" v-if="view_form.process_description != null"> {{ view_form.process_description }} </p>
                                    <p class="text-indent" v-else> Empty </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 text-center">
                            <div class="form-group mt-3">
                                <label class="font-weight-bold"> Audio File </label><br>
                                <a :href="view_form.audio_file" :download="'audio'" v-if="view_form.audio_file !== null">
                                    <button type="button" class="btn btn-primary">Download Audio File</button>
                                </a>
                                <h6 v-else> Empty </h6>
                            </div>
                            <div class="form-group mt-3">
                                <label class="font-weight-bold"> Instruction File </label><br>
                                <a :href="view_form.instruction_file" :download="'instruction'" v-if="view_form.instruction_file !== null">
                                    <button type="button" class="btn btn-primary">Download Instruction File</button>
                                </a>
                                <h6 v-else> Empty </h6>
                            </div>
                            <div class="form-group mt-3">
                                <label class="font-weight-bold"> Video File </label><br>
                                <a :href="view_form.video_file" :download="'video'" v-if="view_form.video_file !== null">
                                    <button type="button" class="btn btn-primary">Download Video File</button>
                                </a>
                                <h6 v-else> Empty </h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editFormModal" tabindex="-1" role="dialog" aria-labelledby="editFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewFormModalLabel"><span class="font-weight-bold">Edit Form/Process</span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editForm">
                    <div class="modal-body pl-5 pr-5">
                        <div class="form-group">
                            <label>Form Title</label>
                            <input type="text" class="form-control" v-model="edit_form.form_title">
                        </div>
                        <div class="form-group">
                            <label>Form Description</label>
                            <input type="text" class="form-control" v-model="edit_form.form_desc">
                        </div>
                        <div class="form-group">
                            <label>Process Title</label>
                            <input type="text" class="form-control" v-model="edit_form.process_title">
                        </div>
                        <div class="form-group">
                            <label>Process Description</label>
                            <input type="text" class="form-control" v-model="edit_form.process_desc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            all_forms: [],
            form_title: '',
            form_desc: '',
            process_title: '',
            process_desc: '',
            view_form: [],
            edit_form: {
                id: '',
                form_title: '',
                form_desc: '',
                process_title: '',
                process_desc: '',
            }
        }
    },
    mounted() {
        this.getForms();
    },
    methods: {
        editForm() {
            Swal.fire({
                title: 'Edit Form and/or Process?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/forms/editForms', {
                        id: this.edit_form.id,
                        form_title: this.edit_form.form_title,
                        form_description: this.edit_form.form_desc,
                        process_title: this.edit_form.process_title,
                        process_description: this.edit_form.process_desc
                    }).then(reponse => {
                        Swal.fire(
                            'Success!',
                            'Form/Process is edited.',
                            'success'
                        )
                        
                        this.edit_form.id = '';
                        this.edit_form.form_title = '';
                        this.edit_form.form_desc ='';
                        this.edit_form.process_title = '';
                        this.edit_form.process_desc = '';
                        $('#editFormModal').modal('hide')
                        this.getForms();
                    })
                }
            });
        },
        transferValue(form) {
            this.edit_form.id = form.id;
            this.edit_form.form_title = form.form_title;
            this.edit_form.form_desc = form.form_description;
            this.edit_form.process_title = form.process_title;
            this.edit_form.process_desc = form.process_description;
        },
        viewForm(form) {
            this.view_form = form;
        },
        deleteForm(form) {
            Swal.fire({
                title: 'Delete Form/Process?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/forms/delete', {
                        id: form.id
                    }).then(reponse => {
                        Swal.fire(
                            'Success!',
                            'Form/Process is deleted.',
                            'success'
                        )
                        this.getForms();
                    })
                }
            });
        },
        saveForm() {
            Swal.fire({
                title: 'Save Form and/or Process?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData()
                    var file1 = document.querySelector('#audio_file_id');
                    var file2 = document.querySelector('#video_file_id');
                    var file3 = document.querySelector('#instruction_file_id');
                    formData.append('audio_file', file1.files[0]);
                    formData.append('video_file', file2.files[0]);
                    formData.append('instruction_file', file3.files[0]);
                    formData.append('form_title', this.form_title);
                    formData.append('form_desc', this.form_desc);
                    formData.append('process_title', this.process_title);
                    formData.append('process_desc', this.process_desc);

                    axios.post('api/forms/store', formData)
                    .then(response => {
                        if(response.data['message'] === 'Form is saved.') {
                            this.form_title = '';
                            this.form_desc = '';
                            this.process_title = '';
                            this.process_desc = '';
                            document.getElementById("formProcess").reset();

                            Swal.fire(
                                'Success!',
                                'Form is saved.',
                                'success'
                            )
                            $('#addFormModal').modal('hide')
                            this.getForms()
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Form is not saved.',
                                'error'
                            )
                        }
                    })
                }
            });
        },
        getForms() {
            axios.get('api/forms/getForms')
            .then(response => {
                this.all_forms = response.data
            })
        },
    }
}
</script>
