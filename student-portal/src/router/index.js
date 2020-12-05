import Vue from "vue";
import VueRouter from "vue-router";
import store from "./../store";

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
    component: () => import("../views/user/home/UserHome.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings",
    name: "Settings",
    component: () => import("../views/user/settings/Settings.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/messagelist",
    name: "MessageList",
    component: () => import("../views/user/message/MessageList.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/message",
    name: "Message",
    component: () => import("../views/user/message/Message.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class",
    name: "Class",
    component: () => import("../views/user/class/Class.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/grades",
    name: "Grades",
    component: () => import("../views/user/class/Grades.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/user/register/Register.vue")
  }
];

const router = new VueRouter({
  // mode: "history",
  // routes: routes
  routes
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(x => x.meta.requiresAuth);
  let isLogin = store.state.isLogin;
  if (requiresAuth && isLogin == false) {
    return next("/");
  } else {
    if (to.name == "UserLogin" && isLogin) {
      return next(false);
    }
    return next();
  }
});
export default router;
