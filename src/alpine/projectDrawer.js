export default {
  open: false,

  openDrawer() {
    if (!this.open) {
      this.open = true;
    }
  },

  closeDrawer() {
    if (this.open) {
      this.open = false;
    }
  },
};
