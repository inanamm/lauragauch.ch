export default () => ({
  drawerOpen: false,

  init() {
    this.$watch('drawerOpen', (value) => {
      document.body.style.overflow = value ? 'hidden' : 'auto'
    });
  },

  toggleDrawer() {
    this.drawerOpen = !this.drawerOpen
  },

  drawerDialogue() {
    return this.drawerOpen
  },
})
