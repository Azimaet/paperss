<template>
  <!-- Login Form -->
  <form v-if="contextForm === `login`" class="form-authentication" action="/login" method="post">
    <h2>Log in</h2>
    <div class="form-group">
      <input placeholder="Adresse Email" type="text" required name="_username" class="form-control" />
    </div>
    <div class="form-group">
      <input
        placeholder="Mot de Passe"
        type="password"
        required
        name="_password"
        class="form-control"
      />
    </div>

    <BtnLogin></BtnLogin>

    <a href="/register">Don't Have an account? Register now!</a>
  </form>

  <!-- Register Form -->
  <form v-else class="form-authentication" name="registration" method="post">
    <h2>Register</h2>
    <div class="form-group">
      <input
        type="text"
        id="registration_username"
        name="registration[username]"
        required="required"
        maxlength="255"
        placeholder="Nom d'utilisateur"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="email"
        id="registration_email"
        name="registration[email]"
        required="required"
        maxlength="255"
        placeholder="Adresse Email"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        id="registration_password"
        name="registration[password]"
        required="required"
        placeholder="Mot de passe"
        class="form-control"
      />
    </div>
    <div class="form-group">
      <input
        type="password"
        id="registration_confirm_password"
        name="registration[confirm_password]"
        required="required"
        placeholder="Répéter le mot de passe"
        class="form-control"
      />
    </div>

    <BtnRegister></BtnRegister>

    <input type="hidden" v-bind:id="token.id" v-bind:name="token.name" v-bind:value="token.value" />

    <a href="/login">Already have login and password? Log in here!</a>
  </form>
</template>

<script>
import BtnLogin from "../atoms/BtnLogin";
import BtnRegister from "../atoms/BtnRegister";

let token = JSON.parse(
  document.getElementById("layout").getAttribute("data-token")
);

export default {
  data() {
    return {
      token: token
    };
  },
  props: {
    contextForm: {
      type: String
    },
    contextBtn: "form"
  },
  components: {
    BtnLogin,
    BtnRegister
  }
};
</script>


<!-- Css -->
<style>
.form-authentication {
  font-family: "Open Sans", "Helvetica", "Arial", sans-serif;
  background-color: #000;
  text-align: center;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 800px;
  height: auto;
  text-align: center;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;
  color: white;
  padding: 40px 100px;
}

.form-authentication > * {
  margin: 20px 0;
}

.form-group {
  width: 100%;
}

.form-control {
  background-color: #fff;
  color: #333333;
  line-height: 1.2;
  font-size: 18px;
  display: block;
  width: 100%;
  height: 60px;
  padding: 0 20px;
  outline: none;
  border: none;
}
</style>