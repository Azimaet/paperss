<template>
  <h1 class="header_logo">
    <img :src="Logo" alt />
  </h1>
</template>


<script>
import Logo from "../../img/logo.svg";

export default {
  data() {
    return {
      Logo: Logo
      //
    };
  }
};
</script>


<style>
.header_logo {
  left: 50%;
  right: 50%;
  transform: translateX(50%);
}

.header_logo img {
  width: 130px;
}
</style>