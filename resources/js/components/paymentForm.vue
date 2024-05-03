<template>
  <div class="mt-5">
    <form @submit.prevent="submitForm" method="post" autocomplete="off">
      <div class="grid gap-y-4">
        <div>
          <label for="cardNumber" class="block text-sm mb-2 dark:text-white">Card Number</label>
          <div class="relative">
            <input v-model="cardNumber" type="text" id="cardNumber" name="cardNumber" class="py-3 px-4 border block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="cardNumber-error" maxlength="19">
          </div>
        </div>
        <div class="grid grid-cols-2 py-2">
          <div class="relative">
            <label for="expiryDate" class="block text-sm mb-2 dark:text-white">Expiry Date (MM/YY)</label>
            <input v-model="expiryDate" type="text" id="expiryDate" name="expiryDate" class="py-3 px-4 block w-20 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="expiryDate-error" maxlength="5">
          </div>
          <div class="relative">
            <label for="cvv" class="block text-sm mb-2 dark:text-white">CVV</label>
            <input v-model="cvv" type="text" id="cvv" name="cvv" class="py-3 px-4 block w-20 border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" required aria-describedby="cvv-error">
          </div>
        </div>
        <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Add</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'; // Import Axios library

export default {
  data() {
    return {
      cardNumber: '',
      expiryDate: '',
      cvv: ''
    };
  },
  watch: {
    cardNumber(newValue) {
      // Format card number by adding spaces every four characters
      this.cardNumber = newValue.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim();
    },
    expiryDate(newValue) {
      // Format expiry date by adding a slash after the first two characters
      this.expiryDate = newValue.replace(/\D/g, '').replace(/(\d{2})(\/)?(\d{0,2})/, '$1/$3').trim();
    }
  },
  methods: {
    submitForm() {
      // Regular expressions to validate card number, expiry date, and CVV
      const cardNumberRegex = /^\d{4} ?\d{4} ?\d{4} ?\d{4}$/;
      const expiryDateRegex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
      const cvvRegex = /^[0-9]{3,4}$/;


      if (!cardNumberRegex.test(this.cardNumber)) {
        alert('Please enter a valid card number.');
        return;
      }

      if (!expiryDateRegex.test(this.expiryDate)) {
        alert('Please enter a valid expiry date in the format MM/YY.');
        return;
      }

      if (!cvvRegex.test(this.cvv)) {
        alert('Please enter a valid CVV.');
        return;
      }

      axios.post('/addPayment', {
          cardNumber: this.cardNumber.toString(),
          expiryDate: this.expiryDate.toString(),
          cvv: this.cvv.toString()
        })
        .then(response => {
          // Handle success response
          console.log(response.data);
          alert('Payment added successfully.');

          window.location.href = '/cart';
          // Optionally, you can redirect the user or perform other actions here
        })
        .catch(error => {
          // Handle error response
          console.error(error);
          alert('Failed to add payment. Please try again later.');
        });
    }
  }
};
</script>
