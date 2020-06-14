<template>
  <div>
    <Header></Header>
    <Home v-if="layout === 'Home'"></Home>
    <Login v-if="layout === 'Login'"></Login>
    <Register v-if="layout === 'Register'"></Register>
  </div>
</template>

<script>
import Header from "../organisms/Header";
import Home from "../templates/Home";
import Login from "../templates/Login";
import Register from "../templates/Register";

let layout = document.getElementById("layout").getAttribute("data-template");

export default {
  data() {
    return {
      layout: layout
    };
  },
  components: {
    Header,
    Home,
    Login,
    Register
  }
};
</script>

<style>
</style>