<template>
    <h1>I'm here to test!</h1>
</template>

<script setup>
import {useToast} from 'vue-toast-notification';

const $toast = useToast();

$toast.open({
    message: 'Success',
    type: 'success',
    position: 'top-right'
})
</script>