<template>
  <input type="date" v-model="date" class="holiday-date-input" />
</template>

<script>
export default {
  name: 'HolidayDateInput',
  data() {
    return {
      date: ''
    };
  }
};
</script>

<style scoped>
.holiday-date-input {
  padding: 0.5rem;
  border-radius: 4px;
  border: 1px solid #ccc;
}
</style>
