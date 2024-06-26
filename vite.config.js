import {globSync} from "glob";
import {resolve} from "path";
import kirby from "vite-plugin-kirby";

const input = globSync(["src/index.{js,css}", "src/templates/*.{js,css}"]).map(
  (path) => resolve(process.cwd(), path)
);

export default ({mode}) => ({
  root: "src",
  base: mode === "development" ? "/" : "/dist/",

  resolve: {
    alias: [{find: "@", replacement: resolve(__dirname, "src")}],
  },

  build: {
    outDir: resolve(process.cwd(), "public_html/dist"),
    emptyOutDir: true,
    rollupOptions: {input},
  },

  plugins: [kirby()],
});
