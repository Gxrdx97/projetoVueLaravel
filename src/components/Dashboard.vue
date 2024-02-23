<template>
  <div class="container">
    <!-- Cabeçalho da tabela -->
    <div class="row">
      <div class="col mb-5">#Nº pedido</div>
      <div class="col mb-5">Cliente</div>
      <div class="col mb-5">Pão</div>
      <div class="col mb-5">Carne</div>
      <div class="col mb-5">Opção</div>
      <div class="col mb-5">Observação</div>
      <div class="col mb-5">Ações</div>
    </div>
    <!-- Linhas da tabela -->
    <div id="burger-table-rows">
      <div
        class="row burger-table-row"
        v-for="burger in burgers"
        :key="burger.id"
      >
        <div class="col mb-5">{{ burger.id }}</div>
        <!-- ID do burger -->
        <div class="col mb-5">{{ burger.name }}</div>
        <!-- Nome do cliente -->
        <div class="col mb-5">{{ burger.bread }}</div>
        <!-- Tipo de pão -->
        <div class="col mb-5">{{ burger.meat }}</div>
        <!-- Tipo de carne -->
        <div class="col mb-5">
          <!-- Lista de opções -->
          <ol class="list-group list-group-numbered">
            <li
              class="list-group-item"
              v-for="(option, index) in burger.option"
              :key="index"
            >
              {{ option }}
            </li>
          </ol>
        </div>
        <div class="col mb-5">{{ burger.obs }}</div>
        <!-- Observações -->
        <div class="col mb-5">
          <!-- Ações -->
          <select name="status" class="form-select status">
            <option value="">Selecione</option>
            <option
              v-for="state in status"
              :key="state.id"
              value="state.tipo"
              :selected="burger.status == state.tipo"
            >
              {{ state.tipo }}
            </option>
          </select>
          <button
            class="btn btn-danger delete-btn"
            @click="deleteBurger(burger.id)"
          >
            Excluir
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Dashboard",
  data() {
    return {
      burgers: null, // Array de burgers
      burger_id: null, // ID do burger selecionado
      status: [], // Opções de status
    };
  },
  methods: {
    // Método assíncrono para excluir um burger
    async deleteBurger(id) {
      try {
        // Envia uma requisição DELETE para excluir o burger com o ID fornecido
        const response = await fetch(`http://localhost:3000/burgers/${id}`, {
          method: "DELETE",
        });

        // Verifica se a exclusão foi bem-sucedida
        if (!response.ok) {
          throw new Error("Erro ao excluir o burger.");
        }

        // Atualiza os pedidos após a exclusão bem-sucedida do burger
        await this.getPedidos();
      } catch (error) {
        console.error("Ocorreu um erro ao excluir o burger:", error);
      }
    },

    // Método assíncrono para buscar os pedidos
    async getPedidos() {
      try {
        // Realiza uma requisição GET para obter os pedidos do servidor
        const response = await fetch("http://localhost:3000/burgers");
        // Converte a resposta para formato JSON
        const data = await response.json();
        // Atribui os pedidos à variável burgers
        this.burgers = data;
        // Atualiza as opções de status
        this.getStatus();
      } catch (error) {
        console.error(error); // Captura e exibe erros
      }
    },

    // Método assíncrono para buscar as opções de status
    async getStatus() {
      try {
        // Realiza uma requisição GET para obter as opções de status do servidor
        const response = await fetch("http://localhost:3000/status");
        // Converte a resposta para formato JSON
        const res = await response.json();
        // Atribui as opções de status à variável status
        this.status = res;
      } catch (error) {
        console.error(error);
      }
    },
  },

  // Método executado após o componente ser montado
  mounted() {
    // Chama o método getPedidos() para buscar os pedidos
    this.getPedidos();
    // Chama o método getStatus() para buscar as opções de status
    this.getStatus();
  },
};
</script>
