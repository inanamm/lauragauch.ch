import { globSync } from "glob";
import kirby from "vite-plugin-kirby";
import tailwindcss from "@tailwindcss/vite";

export default ({ mode }) => ({
  root: "src",
  base: mode === "development" ? "/" : "/dist/",

  build: {
    outDir: "../public_html/dist",
    emptyOutDir: true,
    rollupOptions: {
      input: globSync("src/{index.css,templates/*}.{js,css}"),
    },
  },

  plugins: [tailwindcss(), kirby()],
});
