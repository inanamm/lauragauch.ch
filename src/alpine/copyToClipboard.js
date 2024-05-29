export default (clipboardText = "") => ({
  text: clipboardText,

  copyToClipboard() {
    navigator.clipboard.writeText(this.text)
      .then(() => {
        this.$refs.copyToClipboardRef.style.fontSize = "0.97rem";
        setTimeout(() => {
          this.$refs.copyToClipboardRef.style.fontSize = "0.95rem";

        },150)
      })
      .catch(error => console.log(error))
  }
})

