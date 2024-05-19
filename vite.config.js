import kirby from 'vite-plugin-kirby'

export default ({mode}) => ({
  root: 'src',
  base: mode === 'development' ? '/' : '/dist/',

  build: {
    outDir: 'public/dist',
    emptyOutDir: true,
    rollupOptions: {input: ['main.js', 'home.js', 'main.css']}
  },

  plugins: [kirby()]
})
