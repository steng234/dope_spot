
<template>
   
  <div>
    <!-- Background overlay -->
    <div class="fixed z-20 inset-0 w-full h-full justify-center flex items-center" v-if="showModal" style="background-color: rgb(120,140,160,0.7); background: 50;">
    <!-- Modal -->
    <div class="fixed z-20 inset-0 overflow-y-auto overflow-hidden justify-center flex items-center w-100  ">
      <div class="flex items-center justify-center  h-fit   text-center block p-0 grid grid-rows-1 border border-trasparent bg-white rounded-md shadow-md ">
         
        <!-- Modal content -->
        <div class=" bg-white justify-center flex items-centerrounded-lg h-fit text-left overflow-hidden shadow-xl transform transition-all  max-w-lg w-full p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
         <div>

        
          <div>
            <div class="grid grid-cols-3">
            <div class="justify-left flex py-4 w-10">
          <button @click="$emit('close')" class="text-gray-600 " type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z"/>
            <line x1="16" y1="7" x2="7" y2="16" />
            <line x1="7" y1="7" x2="16" y2="16" />
          </svg>
          </button>
         </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 flex justify-center items-center" id="modal-headline">Modify Data</h3>
          </div>
            <div class="mt-3 text-center grid grid-cols-2 gap-4">
          <!-- First column -->
          <div>
            <input v-model="formData.name" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40 " placeholder="Name">
          </div>
          <div>
            <input v-model="formData.address" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40" placeholder="Address">
          </div>
          <div>
            <input v-model="formData.postal" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40" placeholder="Postal Code">
          </div>
          <!-- Second column -->
          <div>
            <input v-model="formData.city" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40" placeholder="City">
          </div>
          <div>
            <input v-model="formData.state" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40" placeholder="State">
          </div>
          <div >
            <input v-model="formData.telephone" type="text" class="p-2 border border-gray-300 rounded-md sm:w-full w-40" placeholder="Telephone">
          </div>
        </div>
          </div>
          <!-- Button to save changes -->
          <div class="pt-5 ">
            <button @click="saveChanges" type="button" class="inline-flex justify-center w-full border border-transparent rounded-md shadow-sm px-4 py-2 bg-blue-600 text-base text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
              Save Changes
            </button>
          </div>
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
