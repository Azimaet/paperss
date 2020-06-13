<template>
  <header>
    <BtnMenu></BtnMenu>
    <Logo></Logo>
    <BtnsUser></BtnsUser>
  </header>
</template>


<script>
import BtnMenu from "../atoms/BtnMenu";
import Logo from "../atoms/Logo";
import BtnsUser from "../molecules/BtnsUser";

export default {
  data() {},
  components: {
    BtnMenu,
    Logo,
    BtnsUser
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