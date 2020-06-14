<template>
  <form class="form-login" action="/login" method="post">
    <h2>Log in</h2>
    <div>
      <input placeholder="Adresse Email" type="text" required name="_username" />
    </div>
    <div>
      <input placeholder="Mot de Passe" type="password" required name="_password" />
    </div>

    <BtnLogin></BtnLogin>

    <a href="/register">Don't Have an account? Register now!</a>
  </form>
</template>

<script>
import BtnLogin from "../atoms/BtnLogin";

export default {
  data() {
    return {
      //
    };
  },
  components: {
    BtnLogin
  }
};
</script>


<!-- Css -->
<style>
.form-login {
  font-family: "Open Sans", "Helvetica", "Arial", sans-serif;
  background-color: #000;
  text-align: center;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 800px;
  height: 450px;
  text-align: center;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;
  color: white;
  padding: 40px 100px;
}

.form-login > div {
  width: 100%;
}

.form-login input {
  background: white;
  color: #333333;
  line-height: 1.2;
  font-size: 18px;
  display: block;
  width: 100%;
  background: transparent;
  height: 60px;
  padding: 0 20px;
  outline: none;
  border: none;
}
</style>