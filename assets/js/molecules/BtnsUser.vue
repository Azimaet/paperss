<template>
  <nav>
    <BtnRegister v-if="user === null"></BtnRegister>
    <BtnLogin v-if="user === null"></BtnLogin>
  </nav>
</template>


<script>
import BtnRegister from "../atoms/BtnRegister";
import BtnLogin from "../atoms/BtnLogin";
import BtnProfile from "../atoms/BtnProfile";
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
    BtnProfile,
    BtnLogout
  }
};
</script>


<!-- Css -->
<style>
</style>