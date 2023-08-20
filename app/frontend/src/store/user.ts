import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', {
  state: () => ({
    form: <userForm>{
      firstName: '',
      lastName: '',
      email: '',
      isLoading: false,
    },
    responseData: <responseData>{},
    validation: {
      firstName: {
        errorMessage: <string[]>[],
      },
      lastName: {
        errorMessage: <string[]>[],
      },
      email: {
        errorMessage: <string[]>[],
      }
    }
  }),
  actions: {
    async submitForm() {

      this.form.isLoading = true;
      const result = await axios.request({
        method: 'post',
        url: 'http://localhost/api/create-user/',
        data: {
          firstName: this.form.firstName,
          lastName: this.form.lastName,
          email: this.form.email,
        },
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
      }).catch(function (error) {
        if (error.response) {
          console.log(error.response.data);
          console.log(error.response.status);
          console.log(error.response.headers);
        }
      })
      this.responseData = result?.data;
      this.form.isLoading = false;
      this.$reset;
    },
    validateForm() {
      const emailValid = this.validateEmail();
      const firstNameValid = this.validateFirstName();
      const lastNameValid = this.validateLastName();
      if (emailValid &&
        firstNameValid &&
        lastNameValid
      ) {
        this.submitForm();
      }
      return false;
    },
    validateFirstName() {
      if (this.form.firstName.length < 1 || this.form.firstName.length > 255) {
        this.validation.firstName.errorMessage.push('Имя должно быть заполнено и быть меньше 255 символов');
        return false;
      }

      this.validation.firstName.errorMessage = [];
      return true;
    },
    validateLastName() {
      if (this.form.lastName.length < 1 || this.form.lastName.length > 255) {
        this.validation.lastName.errorMessage.push('Фамилия должна быть заполнена и быть меньше 255 символов');
        return false;
      }
      this.validation.lastName.errorMessage = [];
      return true;
    },
    validateEmail() {
      if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(this.form.email)) {
        this.validation.email.errorMessage = [];
        return true;
      }

      this.validation.email.errorMessage.push('Email не валидный');

      if (this.form.email.length < 1 || this.form.email.length > 255) {
        this.validation.email.errorMessage.push('Email должен быть меньше 255 символов');
      }

      return false;
    },
  },
});