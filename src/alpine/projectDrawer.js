export default {
  open: false,

  toggle() {
    console.log("toggling");
    this.open = !this.open;
  },

  openDrawer() {
    console.log("click opening")
    if (!this.open) {
      console.log("opening")
      this.open = true;
    }
  },

  closeDrawer() {
    console.log("click closing")
    if (this.open) {

      console.log("closing")
      this.open = false;
    }
  },
}
