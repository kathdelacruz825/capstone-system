import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "UserLogin",
    component: () => import("../views/UserLogin.vue")
    // meta: {
    //   requiresAuth: false
    // }
  },
  {
    path: "/admin/login",
    name: "AdminLogin",
    component: () => import("../views/AdminLogin.vue")
  },
  {
    path: "/admin/home",
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
    path: "/settings/changepassword",
    name: "ChangePassword",
    component: () => import("../views/user/settings/ChangePassword.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/parentinfo",
    name: "ParentInfo",
    component: () => import("../views/user/settings/ParentInfo.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/parentinfo/view",
    name: "ParentInfoView",
    component: () => import("../views/user/settings/ParentInfoView.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/childinfo/view",
    name: "ChildInfoView",
    component: () => import("../views/user/settings/ChildInfoView.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/about",
    name: "About",
    component: () => import("../views/user/settings/About.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/editinfo",
    name: "EditInfo",
    component: () => import("../views/user/settings/EditInfo.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/settings/viewrecord",
    name: "ViewRecords",
    component: () => import("../views/user/settings/ViewRecords.vue"),
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
    path: "/class/quizzes",
    name: "Quizzes",
    component: () => import("../views/user/class/Quizzes.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/quizzes/quizview/:subject?/:subjectid?",
    name: "QuizView",
    component: () => import("../views/user/class/quiz/QuizView.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/examinations",
    name: "Examinations",
    component: () => import("../views/user/class/Examinations.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/examinations/examview/:period?/:periodid?",
    name: "ExamView",
    component: () => import("../views/user/class/examinations/ExamView.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/schedule",
    name: "Schedule",
    component: () => import("../views/user/schedule/Schedule.vue"),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: "/class/attendance",
    name: "Attendance",
    component: () => import("../views/user/attendance/Attendance.vue"),
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

// router.beforeEach((to, from, next) => {
//   const requiresAuth = to.matched.some(x => x.meta.requiresAuth);
//   let isAuthenticated = localStorage.getItem("user") != null ? true : false;
//   // let isLogin = localStorage.getItem('isLogin') != null ? localStorage.getItem('isLogin') : false;
//   if (requiresAuth && isAuthenticated == false) {
//     return next("/");
//   } else {
//     if (to.name == "UserLogin" && isAuthenticated == true) {
//       return next(false);
//     } else {
//       return next();
//     }
//   }
// });
export default router;
