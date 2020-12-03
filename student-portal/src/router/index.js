import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "UserLogin",
    component: () => import("../views/UserLogin.vue")
  },
  {
    path: "/admin/login",
    name: "AdminLogin",
    component: () => import("../views/AdminLogin.vue")
  },
  {
    path: "/admin",
    name: "AdminHome",
    component: () => import("../views/admin/home/AdminHome.vue")
  },
  {
    path: "/user",
    name: "UserHome",
    component: () => import("../views/user/home/UserHome.vue")
  },
  {
    path: "/settings",
    name: "Settings",
    component: () => import("../views/user/settings/Settings.vue")
  },
  {
    path: "/messagelist",
    name: "MessageList",
    component: () => import("../views/user/message/MessageList.vue")
  },
  {
    path: "/message",
    name: "Message",
    component: () => import("../views/user/message/Message.vue")
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/user/register/Register.vue")
  }
];

const router = new VueRouter({
  routes
});

export default router;
