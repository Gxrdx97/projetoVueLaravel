<template>
  <div class="alert alert-info" role="alert">
    <p>{{ msg }}</p>
  </div>
</template>
<script>
export default {
  name: "Message",
  props: {
    msg: String,
  },
};
</script>
