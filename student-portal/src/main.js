import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import Vant from "vant";
import "vant/lib/index.css";
import "./assets/css/main.scss";

import http from "./lib/http-common";
import { api } from "./utils/api";
Vue.prototype.http = http;
Vue.prototype.api = api;
Vue.use(Vant);
Vue.use(ElementUI);
Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
