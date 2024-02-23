<template>
  <div class="main-banner">
    <h1>Make your burger</h1>
  </div>
</template>

<script>
export default {
  name: "Background",
};
</script>

<style scoped>
.main-banner {
  background-image: url("/public/img/burger.jpg");
  background-position: 0 -310px;
  background-size: cover;
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

.main-banner h1 {
  color: #fff;
  text-align: center;
  font-size: 60px;
  padding: 20px 40px;
  background-color: #222;
}
</style>
