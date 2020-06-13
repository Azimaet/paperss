<template>
  <a class="btn-register" href="/register">Register</a>
</template>


<script>
export default {
  data() {
    return {
      //
    };
  }
};
</script>


<!-- Css -->
<style>
.btn-register {
  text-transform: uppercase;
  font-family: "Ubuntu", Helvetica, Arial, sans-serif;
  font-weight: normal;
  -webkit-font-smoothing: antialiased;
  padding: 0 16px;
  border: none;
  border-radius: 2px;
  outline: 0;
  text-decoration: none;
  color: #000000;
  background-color: #eeeeee;
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

.btn-register:hover {
  background-color: #ffffff;
  transition: background-color 0.2s;
}
</style>