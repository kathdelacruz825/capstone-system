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
    path: "/register",
    name: "Register",
    component: () => import("../views/user/register/Register.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  routes: routes
  // routes
});

router.beforeEach((to, from, next) => {
  let accountID = localStorage.getItem("accountID");
  const requiresAuth = to.matched.some(x => x.meta.requiresAuth);
  if (requiresAuth && accountID == null) {
    next("/");
  } else {
    if (to.name == "UserLogin" && accountID) {
      return next(false);
    }
    return next();
  }
});
export default router;
