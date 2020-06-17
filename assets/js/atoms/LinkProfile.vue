<template>
  <a class="link-profile" href="#">Hello {{ username }}!</a>
</template>


<script>
export default {
  props: {
    username: {
      required: true
    }
  },
  data() {
    return {
      //
    };
  }
};
</script>


<!-- Css -->
<style>
.link-profile {
  font-weight: normal;
  -webkit-font-smoothing: antialiased;
  display: inline-block;
  vertical-align: middle;
  font-size: 14px;
  font-family: Helvetica, Arial, sans-serif;
}
</style>