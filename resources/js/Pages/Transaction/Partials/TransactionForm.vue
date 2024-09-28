<template>
    <div>
      <form @submit.prevent="submitTransaction">
        <div class="mb-3">
          <label for="contactNumber" class="form-label">Contact Number</label>
          <input
            id="contactNumber"
            v-model="form.contact_number"
            type="text"
            class="form-control"
            required
            placeholder="Enter contact number"
          />
        </div>
  
        <div class="mb-3">
          <label for="transactionType" class="form-label">Transaction Type</label>
          <select
            id="transactionType"
            v-model="form.transaction_type"
            class="form-select"
            required
          >
            <option value="Cash In">Cash In</option>
            <option value="Cash Out">Cash Out</option>
          </select>
        </div>
  
        <div class="mb-3">
          <label for="amount" class="form-label">Amount</label>
          <input
            id="amount"
            v-model="form.amount"
            type="number"
            step="0.01"
            class="form-control"
            required
            placeholder="Enter amount"
          />
        </div>
  
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-block">Save Transaction</button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  // Props and emit setup
  const props = defineProps({});
  const emit = defineEmits(['transaction-saved']);
  
  const form = ref({
    contact_number: '',
    transaction_type: '',
    amount: '',
  });
  
  const submitTransaction = async () => {
    try {
      await axios.post('/api/transactions', form.value);
      //alert('Transaction saved successfully!');
      // Clear the form after saving
      form.value.contact_number = '';
      form.value.transaction_type = '';
      form.value.amount = '';
  
      // Emit event to notify parent component
      emit('transaction-saved');
    } catch (error) {
      console.error('Error saving transaction:', error);
    }
  };
  </script>
  