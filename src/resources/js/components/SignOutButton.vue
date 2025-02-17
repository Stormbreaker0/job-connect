<template>
  <form :action="logoutUrl" method="post" class="ms-auto me-3 me-lg-4" id="form-logout">
    <input type="hidden" name="_token" :value="csrfToken">
    <button type="submit" class="btn btn-link btn-sm text-white custom-signout-button">
      <span class="button-content">
        <i class="fas fa-sign-out-alt"></i> Logout
      </span>
    </button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      logoutUrl: "/logout",
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
  }
};
</script>

<style scoped>
.custom-signout-button {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 10px 15px;
  font-size: 16px;
  border: none;
  background-color: transparent;
  color: #ffffff;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s, transform 0.3s;
}

.custom-signout-button:hover {
  background-color: #ff4d4d;
  color: #ffffff;
  transform: scale(1.1);
}

.button-content {
  display: flex;
  align-items: center;
  gap: 8px;
}

.button-content i {
  font-size: 18px;
}
</style>