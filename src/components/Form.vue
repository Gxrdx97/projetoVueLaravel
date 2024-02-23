<template>
  <div class="container mt-5 display-flex mb-5">
    <div class="row">
      <div class="col">
        <p class="h3">Make your burger</p>
        <form id="bgFr" @submit.prevent="submitBtn">
          <div class="form-group">
            <label for="name">Nome do cliente:</label>
            <input
              type="text"
              class="form-control"
              name="name"
              id="name"
              v-model="name"
              placeholder="Digite o seu nome"
            />
          </div>
          <div class="form-group">
            <label for="bread">Escolha seu pão:</label>
            <select
              class="form-control"
              name="bread"
              id="bread"
              v-model="bread"
              v-if="breads"
            >
              <option value="">Selecione seu pão</option>
              <option
                v-for="bread in breads"
                :key="bread.id"
                :value="bread.tipo"
              >
                {{ bread.tipo }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="meat">Escolha sua carne:</label>
            <select
              class="form-control"
              name="meat"
              id="meat"
              v-if="meats"
              v-model="meat"
            >
              <option value="">Selecione sua carne</option>
              <option v-for="meat in meats" :key="meat.id" :value="meat.tipo">
                {{ meat.tipo }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="options">Escolha os opcionais:</label>
            <div class="form-check" v-for="option in options" :key="option.id">
              <input
                type="checkbox"
                class="form-check-input"
                :id="'option_' + option.id"
                :value="option.tipo"
                v-model="selectedOptions"
              />
              <label :for="'option_' + option.id" class="form-check-label">{{
                option.tipo
              }}</label>
            </div>
          </div>
          <div class="form-group mt-2">
            <textarea
              class="form-control"
              name="obs"
              id="obs"
              v-model="obs"
              placeholder="Faça observações do lanche"
            ></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-3">
            Finalizar pedido
          </button>
          <Message :msg="msg" v-show="msg" />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Message from "./Message.vue";
export default {
  components: { Message },
  name: "Form",
  mounted() {
    this.getIngredients();
  },
  data() {
    return {
      options: [],
      meats: null,
      breads: null,
      name: null,
      bread: null,
      meat: null,
      selectedOptions: [],
      msg: null,
      obs: null,
      status:"Solicitado"
    };
  },
  methods: {
    async getIngredients() {
      try {
        const response = await fetch("http://localhost:3000/ingredientes");
        const data = await response.json();
        this.breads = data.paes;
        this.meats = data.carnes;
        this.options = data.opcionais;
      } catch (error) {
        console.error("Erro ao buscar ingredientes:", error);
      }
    },
    async submitBtn() {
      const data = {
        name: this.name,
        meat: this.meat,
        bread: this.bread,
        option: this.selectedOptions,
        obs: this.obs,
        status: this.status,
      };

      try {
        const response = await fetch("http://localhost:3000/burgers", {
          method: "POST",
          headers: { "Content-type": "application/json" },
          body: JSON.stringify(data),
        });

        const res = await response.json();
        this.msg = `pedido Nº ${res.id} realizado com sucesso`;
        console.log(res);

        // Reset form
        this.name = "";
        this.meat = "";
        this.bread = "";
        this.obs = "";
        this.selectedOptions = [];
      } catch (error) {
        console.error("Erro ao enviar pedido:", error);
      }

      setTimeout(() => {
        this.msg = null;
      }, 3000);
    },
  },
};
</script>
