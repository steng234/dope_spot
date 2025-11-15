<template>
  <div>
    <div class="fixed z-20 inset-0 w-full h-full justify-center flex items-center" v-if="showModal" style="background-color: rgb(120,140,160,0.7); background: 50;">
      <div class="fixed z-20 inset-0 overflow-y-auto overflow-hidden justify-center flex items-center w-100">
        <div class="flex items-center justify-center  h-fit   text-center block p-0 grid grid-rows-1 border border-trasparent bg-white rounded-md shadow-md ">
          <div class=" bg-white justify-center flex items-centerrounded-lg w-60 h-fit text-left overflow-hidden shadow-xl transform transition-all  max-w-lg w-full p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
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
                  <h3 class="text-lg leading-6 font-medium text-gray-900 flex justify-center items-center" id="modal-headline">Modify&nbsp;Password</h3>
                </div>
                <div class="mt-3 text-center grid grid-cols-1 gap-4">
                  <div>
                    <input v-model="formData.old" type="password" class="p-2 border border-gray-300 rounded-md w-48" placeholder="old password">
                  </div>
                  <div>
                    <input v-model="formData.new" type="password" class="p-2 border border-gray-300 rounded-md w-48" placeholder="new password">
                  </div>
                  <div>
                    <input v-model="formData.confirmNew" type="password" class="p-2 border border-gray-300 rounded-md w-48" placeholder="confirm new password">
                  </div>
                </div>
              </div>
              <div v-if="passwordsMatchError" class="text-red-500">Passwords do not match</div>
              <div class="pt-5 sm:pt-6 flex justify-center">
                <button @click="saveChanges" type="button" class=" w-48 inline-flex justify-center text-white border border-transparent rounded-md shadow-sm px-4 py-2 bg-blue-600 text-base font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
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
  
  export default{
    props:{
      showModal: Boolean
    },
    data(){
      return{
        formData:{
        old: '',
        new: '',
        confirmNew: '',
      },
      passwordsMatchError: false,
      };
    },
    methods:{
      saveChanges(){ 
        if(this.formData.newPassword !== this.formData.confirmNewPassword){
          this.passwordsMatchError = true;
          return;
        }
    axios.post('/update-password', this.formData)
      .then(response =>{
       location.reload();
      })
      .catch(error =>{
        console.error('Error saving data:', error);
      });
      }
    }
  };
  
  
</script>
  