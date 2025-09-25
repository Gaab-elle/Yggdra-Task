<template>
  <div v-if="visible" class="holiday-toast">
    {{ message }}
  </div>
</template>

<script>
export default {
  name: 'HolidayToastManager',
  data() {
    return {
      visible: false,
      message: ''
    };
  },
  methods: {
    show(msg) {
      this.message = msg;
      this.visible = true;
      setTimeout(() => {
        this.visible = false;
      }, 3000);
    }
  }
};
</script>

<style scoped>
.holiday-toast {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #38bdf8;
  color: #fff;
  padding: 1rem 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
</style>
