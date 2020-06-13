<template>
  <nav>
    <BtnRegister v-if="user === null"></BtnRegister>
    <BtnLogin v-if="user === null"></BtnLogin>
    <LinkProfile v-if="user"></LinkProfile>
    <BtnLogout v-if="user"></BtnLogout>
  </nav>
</template>


<script>
import BtnRegister from "../atoms/BtnRegister";
import BtnLogin from "../atoms/BtnLogin";
import LinkProfile from "../atoms/LinkProfile";
import BtnLogout from "../atoms/BtnLogout";

export default {
  data() {
    return {
      user: user
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