<template>
    <div>
      <button @click="showModal = true"  type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">modify password</button>
      <!-- Include the modal component -->
      <modifyPassword :show-modal="showModal"  @close="showModal = false"  :initial-data="initialData"></modifyPassword>
    </div>
  </template>
  
  <script>
  import modifyPassword from "./modifyPassword.vue"; 
  
  export default {
    components: {
        modifyPassword
    },
    data() {
      return {
        showModal: false, 
      };
    }

  };
  </script>
  