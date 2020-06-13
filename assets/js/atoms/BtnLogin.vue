<template>
  <a class="btn-login" href="/login">Login</a>
</template>


<script>
export default {
  data() {}
};
</script>


<!-- Css -->
<style>
.btn-login {
  text-transform: uppercase;
  font-family: "Ubuntu", Helvetica, Arial, sans-serif;
  font-weight: normal;
  -webkit-font-smoothing: antialiased;
  padding: 0 16px;
  border: none;
  border-radius: 2px;
  outline: 0;
  text-decoration: none;
  color: #ffffff;
  background-color: #4f8e45;
  text-align: center;
  letter-spacing: 0.5px;
  height: 32.4px;
  line-height: 32.4px;
  font-size: 13px;
  display: inline-block;
  overflow: hidden;
  vertical-align: middle;
  transition: background-color 0.2s;
}

.btn-login:hover {
  background-color: #73ab6a;
  transition: background-color 0.2s;
}
</style>