<template>
    <div class="modal" v-if="showModal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <h2>Modify Data</h2>
        <!-- Form inputs for modifying data -->
        <!-- Example: -->
        <input v-model="formData.name" type="text" placeholder="Name">
        <input v-model="formData.email" type="email" placeholder="Email">
        <!-- Button to save changes -->
        <button @click="saveChanges">Save Changes</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      showModal: Boolean,
      initialData: Object
    },
    data() {
      return {
        formData: { ...this.initialData }
      };
    },
    methods: {
      closeModal() {
        this.$emit('close');
      },
      saveChanges() {
        this.$emit('save', this.formData);
        this.closeModal();
      }
    }
  };
  </script>
  
  <style scoped>
  /* Styles for the modal */
  </style>
  