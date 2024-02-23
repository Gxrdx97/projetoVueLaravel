<template>
  <div class="home">
    <Background />
    <Form />
  </div>
</template>

<script>
import Form from "../components/Form.vue";
import Background from "../components/Background.vue";
export default {
  name: "Home",
  components: {
    Background,
    Form,
  },
};
</script>
