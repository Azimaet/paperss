<template>
  <a class="link-profile" href="/logout">Hello {{ test }}!</a>
</template>


<script>
export default {
  data() {
    return {
      test: "Maxou"
    };
  }
};
</script>


<!-- Css -->
<style>
.link-profile {
  font-family: "Ubuntu", Helvetica, Arial, sans-serif;
  font-weight: normal;
  -webkit-font-smoothing: antialiased;
}
</style>