<template>
  <div>
    <Header></Header>
    <Home v-if="layout === 'Home'"></Home>
    <Login v-if="layout === 'Login'"></Login>
  </div>
</template>

<script>
import Header from "../organisms/Header";
import Home from "../templates/Home";
import Login from "../templates/Login";

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
    Login
  }
};
</script>

<style>
</style>