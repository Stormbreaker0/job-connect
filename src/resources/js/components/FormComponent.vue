<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-5">
        <h1>Post a job</h1>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" v-model="form.title" id="title" class="form-control">
            <div v-if="errors.title" class="error">{{ errors.title[0] }}</div>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea v-model="form.description" id="description" class="form-control summernote"></textarea>
            <div v-if="errors.description" class="error">{{ errors.description[0] }}</div>
          </div>

          <div class="form-group">
            <label for="roles">Roles and Responsibility</label>
            <textarea v-model="form.roles" id="roles" class="form-control summernote"></textarea>
            <div v-if="errors.roles" class="error">{{ errors.roles[0] }}</div>
          </div>

          <div class="form-group">
            <label>Job types</label>
            <div class="form-check" v-for="type in jobTypes" :key="type">
              <input type="radio" class="form-check-input" v-model="form.job_type" :id="type" :value="type">
              <label :for="type" class="form-check-label">{{ type }}</label>
            </div>
            <div v-if="errors.job_type" class="error">{{ errors.job_type[0] }}</div>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" v-model="form.address" id="address" class="form-control">
            <div v-if="errors.address" class="error">{{ errors.address[0] }}</div>
          </div>

          <div class="form-group">
            <label for="salary">Salary</label>
            <input type="text" v-model="form.salary" id="salary" class="form-control">
            <div v-if="errors.salary" class="error">{{ errors.salary[0] }}</div>
          </div>

          <!-- Datepicker -->
          <div class="form-group">
            <label for="date">Application closing date</label>
            <Datepicker v-model="form.date" :format="'yyyy-MM-dd'" class="form-control" />
            <div v-if="errors.date" class="error">{{ errors.date[0] }}</div>
          </div>

          <div class="form-group">
            <label for="feature_image">Feature Image</label>
            <input type="file" @change="handleFileUpload" id="feature_image" class="form-control">
            <div v-if="errors.feature_image" class="error">{{ errors.feature_image[0] }}</div>
          </div>

          <div class="form-group mt-4 text-center">
            <button type="submit" class="btn btn-success">Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Datepicker from 'vue3-datepicker';

export default {
  components: {
    Datepicker
  },
  data() {
    return {
      form: {
        title: '',
        description: '',
        roles: '',
        job_type: '',
        address: '',
        salary: '',
        date: '',
        feature_image: null,
      },
      errors: {},
      jobTypes: ['Fulltime', 'Parttime', 'Casual', 'Contract'],
    };
  },
  methods: {
    handleFileUpload(event) {
      this.form.feature_image = event.target.files[0];
    },
    async submitForm() {
      try {
        this.form.description = $('#description').summernote('code');
        this.form.roles = $('#roles').summernote('code');

        const formData = new FormData();
        for (const key in this.form) {
          formData.append(key, this.form[key]);
        }

        const response = await axios.post('create', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
        });

        console.log(response.data);
        if (response.data.success) {
          alert(response.data.success);
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        }
      }
    },
  },
  mounted() {
    $('#description').summernote({
      height: 200,
      callbacks: {
        onChange: (contents) => {
          this.form.description = contents;
        },
      },
    });
    $('#roles').summernote({
      height: 200,
      callbacks: {
        onChange: (contents) => {
          this.form.roles = contents;
        },
      },
    });
  },
};
</script>

<style>
.error {
  color: red;
  font-weight: bold;
}
</style>
