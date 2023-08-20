<template>
  <v-form
    @submit.prevent="store.validateForm()"
  >
    <v-text-field
      v-model="form.firstName"
      label="Имя"
      required
      :error-messages="validation.firstName.errorMessage"
      counter="255"
      v-on:update:focused="store.validateFirstName()"
    ></v-text-field>
    <v-text-field
      v-model="form.lastName"
      label="Фамилия"
      :error-messages="validation.lastName.errorMessage"
      required
      counter="255"
      v-on:update:focused="store.validateLastName()"
    ></v-text-field>
    <v-text-field
      v-model="form.email"
      label="Email"
      required
      counter="255"
      type="email"
      :error-messages="validation.email.errorMessage"
      v-on:update:focused="store.validateEmail()"
    ></v-text-field>
    <v-btn
      type="submit"
      color="primary"
      :disabled="form.isLoading"
    >Отправить</v-btn>
    <v-alert
      class="mt-5"
      v-if="responseData.message"
      variant="tonal"
    >
      {{ responseData.message }}
    </v-alert>
  </v-form>
</template>

<script setup lang="ts">
import { useUserStore } from '@/store/user';
import { storeToRefs } from 'pinia';

const store = useUserStore();

const {validation, form, responseData } = storeToRefs(store);

</script>

