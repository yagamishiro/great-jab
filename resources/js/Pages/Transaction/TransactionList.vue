<template>
    <div class="container mt-4">
      <!-- Transactions List -->
      <h2 class="text-center">Transactions</h2>

      <!-- Button to Open the Modal -->
      <div class="text-end mb-3">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#transactionModal">
          Add Transaction
        </button>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card mb-3" v-for="transaction in transactions" :key="transaction.id">
            <div class="card-body">
              <h5 class="card-title">{{ transaction.transaction_type }}</h5>
              <p class="card-text">Contact Number: {{ transaction.contact_number }}</p>
              <p class="card-text">Amount: ₱{{ transaction.amount }}</p>
              <p class="card-text">Date: {{ formatDate(transaction.transaction_date) }}</p>
            </div>
          </div>
  
          <button
            v-if="hasMore"
            class="btn btn-primary"
            @click="loadMore"
          >
            Load More
          </button>
        </div>
      </div>
  
      <!-- Modal for Adding Transaction -->
      <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="transactionModalLabel">Create Transaction</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <TransactionForm @transaction-saved="onTransactionSaved" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import TransactionForm from './Partials/TransactionForm.vue';
  import {useToast} from 'vue-toast-notification';

  const $toast = useToast();
  
  const transactions = ref([]);
  const page = ref(1);
  const hasMore = ref(true);
  
  const fetchTransactions = async () => {
    try {
      const response = await axios.get(`/api/transactions?page=${page.value}`);
      const data = response.data;
  
      transactions.value.push(...data.data);
  
      // Check if there are more transactions to load
      hasMore.value = data.next_page_url !== null;
    } catch (error) {
      console.error('Error fetching transactions:', error);
    }
  };
  
  const loadMore = () => {
    page.value += 1;
    fetchTransactions();
  };
  
  // Format date helper function
  const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('en-PH', options);
  };
  
  // Handle the event when a new transaction is saved
  const onTransactionSaved = () => {
    // Hide the modal
    document.querySelector('button.btn-close').click();

    $toast.open({
        message: 'Transaction saved successfully!',
        type: 'success',
        position: 'top-right'
    })

    page.value = 1;
    transactions.value = [];
    fetchTransactions();
  };
  
  // Initial fetch
  fetchTransactions();
  </script>
  
  <style scoped>
  .card {
    transition: transform 0.2s;
  }
  
  .card:hover {
    transform: scale(1.02);
  }
  </style>
  