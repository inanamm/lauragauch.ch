export default () => ({
  init() {
    console.log("here!!!!!");
  },

  trigger: {
    ["@mouseover"]() {
      console.log("hello");
    },
  },
});
