<template>
  <header>
    <BtnMenu></BtnMenu>
    <Logo></Logo>
  </header>
</template>


<script>
import BtnMenu from "../atoms/BtnMenu";
import Logo from "../atoms/Logo";

export default {
  data() {},
  components: {
    BtnMenu,
    Logo
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