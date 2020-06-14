<template>
  <nav>
    <LinkRegister v-if="user === null"></LinkRegister>
    <LinkLogin v-if="user === null"></LinkLogin>
    <LinkProfile v-if="user"></LinkProfile>
    <BtnLogout v-if="user"></BtnLogout>
  </nav>
</template>


<script>
import LinkRegister from "../atoms/LinkRegister";
import LinkLogin from "../atoms/LinkLogin";
import LinkProfile from "../atoms/LinkProfile";
import BtnLogout from "../atoms/BtnLogout";

export default {
  data() {
    return {
      user: user
    };
  },
  components: {
    LinkRegister,
    LinkLogin,
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