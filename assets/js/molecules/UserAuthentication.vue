<template>
  <nav>
    <BtnRegister v-if="username === null" v-bind:contextBtn="contextBtn"></BtnRegister>
    <BtnLogin v-if="username === null" v-bind:contextBtn="contextBtn"></BtnLogin>
    <LinkProfile v-if="username" v-bind:username="username"></LinkProfile>
    <BtnLogout v-if="username"></BtnLogout>
  </nav>
</template>


<script>
import BtnRegister from "../atoms/BtnRegister";
import BtnLogin from "../atoms/BtnLogin";
import LinkProfile from "../atoms/LinkProfile";
import BtnLogout from "../atoms/BtnLogout";

let username = document.getElementById("layout").getAttribute("data-username");

export default {
  data() {
    return {
      contextBtn: "header",
      username: username ? username : null
    };
  },
  components: {
    BtnRegister,
    BtnLogin,
    LinkProfile,
    BtnLogout
  }
};
</script>


<!-- Css -->
<style>
nav > * {
  margin: 0 5px;
}
</style>