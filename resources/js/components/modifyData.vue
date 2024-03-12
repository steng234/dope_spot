
<template>
   
  <div>
    <!-- Background overlay -->
    <div class="fixed z-20 inset-0 w-full h-screen opacity-50 " v-if="showModal" style="background-color: rgb(120,140,160,0.7); background: 50;">
    <!-- Modal -->
    <div class="fixed z-20 inset-0 overflow-y-auto overflow-hidden justify-center flex items-center w-100  ">
      <div class="flex items-end justify-center min-h-screen px-4 p-4 pb-20 text-center sm:block sm:p-0 grid grid-rows-1 border border-trasparent bg-white rounded-md shadow-md ">
        <div class="justify-left flex py-4 ">
          <button @click="$emit('close')" class="text-gray-600 " type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"/>
            <line x1="16" y1="7" x2="7" y2="16" />
            <line x1="7" y1="7" x2="16" y2="16" />
          </svg>
          </button>
         </div> 
        <!-- Modal content -->
        <div class="bg-white rounded-lg  px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:m-8 sm:max-w-lg sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
          <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Modify Data</h3>

            <div class="mt-3 text-center sm:mt-5 grid grid-cols-2 gap-4">
          <!-- First column -->
          <div>
            <input v-model="formData.name" type="text" class="p-2 border border-gray-300 rounded-md w-40" placeholder="Name">
          </div>
          <div>
            <input v-model="formData.address" type="text" class="p-2 border border-gray-300 rounded-md" placeholder="Address">
          </div>
          <div>
            <input v-model="formData.postal" type="text" class="p-2 border border-gray-300 rounded-md " placeholder="Postal Code">
          </div>
          <!-- Second column -->
          <div>
            <input v-model="formData.city" type="text" class="p-2 border border-gray-300 rounded-md " placeholder="City">
          </div>
          <div>
            <input v-model="formData.state" type="text" class="p-2 border border-gray-300 rounded-md " placeholder="State">
          </div>
          <div >
            <input v-model="formData.telephone" type="text" class="p-2 border border-gray-300 rounded-md " placeholder="Telephone">
          </div>
        </div>
          </div>
          <!-- Button to save changes -->
          <div class="pt-5 sm:pt-6">
            <button @click="saveChanges" type="button" class="inline-flex justify-center w-full border border-transparent rounded-md shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>

import axios from 'axios';

export default {
  
  props: {
    showModal: Boolean,
    initialData: Object
  },
  data() {
    
    return {
      formData: {
      name: '',
      address: '',
      postal: '',
      city: '',
      state: '',
      telephone: '',
    }
    };
  },
  methods: {
    saveChanges() { 

    const phoneRegex = /^\+(?:[0-9] ?){6,14}[0-9]$/;

    // Check if the telephone number matches the regex pattern
    if (!phoneRegex.test(this.formData.telephone) && this.formData.telephone!='') {
      // If the telephone number doesn't match the pattern, display an error message or handle it accordingly
      alert('Telephone number has incorrect syntax');
      return; // Exit the function early to prevent further execution
    }
    
  axios.post('/update-profile', this.formData)
    .then(response => {
     location.reload();
    })
    .catch(error => {
      console.error('Error saving data:', error);
    });
    }
  }
};


</script>

<style scoped>
/* Styles for the modal */
</style>
