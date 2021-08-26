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
                                <td class="w-10">
                                    <button type="button" class="btn btn-success"><i class="far fa-edit"></i></button>
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
        }
    },
    mounted() {
        this.getForms();
    },
    methods: {
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
