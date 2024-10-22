import { defineConfig } from "vite";

export default defineConfig({
  build: {
    lib: {
      entry: "./main.js",
      name: "larabee",
      fileName: "t",
    },
  },

  server: {
    port: 3001,
    open: false,
    host: "0.0.0.0",
  },
});
