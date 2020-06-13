<template>
  <a class="btn-logout" href="/logout">Logout</a>
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
.btn-logout {
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
  background-color: #bb2626;
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

.btn-logout:hover {
  background-color: #d64949;
  transition: background-color 0.2s;
}
</style>