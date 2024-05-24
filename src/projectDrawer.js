export default {
  open: false,

  // init() {
  //   this.$watch('drawerOpen', (value) => {
  //     document.body.style.overflow = value ? 'hidden' : 'auto'
  //   });
  // },

  toggle() {
    this.open = !this.open
  },
}
