<template>
  <header>
    <BtnMenu></BtnMenu>
    <Logo></Logo>
    <UserAutentication></UserAutentication>
  </header>
</template>


<script>
import BtnMenu from "../atoms/BtnMenu";
import Logo from "../atoms/Logo";
import UserAutentication from "../molecules/UserAutentication";

export default {
  data() {
    return {
      //
    };
  },
  components: {
    BtnMenu,
    Logo,
    UserAutentication
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