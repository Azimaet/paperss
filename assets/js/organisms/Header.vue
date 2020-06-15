<template>
  <header>
    <BtnMenu></BtnMenu>
    <Logo></Logo>
    <UserAuthentication></UserAuthentication>
  </header>
</template>


<script>
import BtnMenu from "../atoms/BtnMenu";
import Logo from "../atoms/Logo";
import UserAuthentication from "../molecules/UserAuthentication";

export default {
  data() {
    return {
      //
    };
  },
  components: {
    BtnMenu,
    Logo,
    UserAuthentication
  }
};
</script>


<!-- Css -->
<style>
header {
  display: flex;
  flex-wrap: nowrap;
  justify-content: space-between;
  align-items: center;
  height: 70px;
  padding: 20px;
  background-color: #000000;
}
</style>