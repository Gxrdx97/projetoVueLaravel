<template>
  <!-- Footer -->
  <footer class="bg-dark footer-dark py-1">
    <!-- Container para centralizar o conteúdo -->
    <div class="container">
      <!-- Linha para alinhar os elementos verticalmente -->
      <div class="row align-items-center justify-content-center">
        <!-- Coluna para o logo e o nome -->
        <div class="col-auto text-center">
          <!-- Logo -->
          <img class="sml" src="/img/logo.png" alt="Burger Market Logo" />
          <!-- Nome -->
          <p style="color: white; margin-bottom: 0">Burger Market</p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  methods: {},
};
</script>

<style scoped>
/* Estilização do footer */
.footer-dark {
  width: 100%;
}

/* Estilização para telas maiores */
@media (min-width: 576px) {
  .footer-dark {
    display: flex; /* Utiliza o flexbox */
    flex-wrap: wrap; /* Permite que os elementos sejam quebrados em várias linhas */
    justify-content: space-between; /* Alinha os elementos horizontalmente com espaçamento igual entre eles */
    align-items: center; /* Alinha os elementos verticalmente */
  }
}
</style>
