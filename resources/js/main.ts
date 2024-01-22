import "virtual:uno.css";

import { createApp } from "vue";

import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router";

// @ts-ignore
import VueProgressBar from "@aacassandra/vue3-progressbar";

const app = createApp(App);

app.use(createPinia());
app.use(router);

const options = {
  color: "#409eff",
  //failedColor: "#874b4b",
  thickness: "2px",
  transition: {
    speed: "0.2s",
    opacity: "0.6s",
    termination: 300,
  },
  autoRevert: true,
};

app.use(VueProgressBar, options);

app.mount("#app");
