import { defineStore } from 'pinia'

export const alertStorage = defineStore('alert', {
  state: () => ({ message: '', alert_type: '' }),
  getters: {
    hasAlert() {
        return this.message != '';
    }
  },
  actions: {
    showAlert(message, type) {
      this.message = message;
      this.type = type;

      setTimeout(()=>{
        this.message = '';
        this.type = '';
      }, 5000);
    }
  },
})