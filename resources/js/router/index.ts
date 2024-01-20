import {
  createRouter,
  createWebHistory,
  createWebHashHistory,
} from "vue-router";

//@ts-ignore
const prefix = window.AmisAdmin.prefix;

const router = createRouter({
  history: createWebHistory(`${prefix}/view/`),
  routes: [
    {
      path: "/",
      name: "layout",
      component: () => import("@/components/layout/Layout.vue"),
      redirect: "home",
      children: [
        {
          path: "/:pathMatch(.*)*",
          component: () => import("@/views/AMisPage.vue"),
        },
      ],
    },
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/Login.vue"),
    },
  ],
});

export default router;
