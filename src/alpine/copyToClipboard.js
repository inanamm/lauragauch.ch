export default (clipboardText = "") => ({
  text: clipboardText,

  copyToClipboard() {
    navigator.clipboard.writeText(this.text)
      .then(() => {
        this.$refs.copyToClipboardRef.style.fontSize = "1rem";
        setTimeout(() => {
          this.$refs.copyToClipboardRef.style.fontSize = "0.95rem";
        }, 200)
      })
      .catch(error => console.log(error))
  }
})
