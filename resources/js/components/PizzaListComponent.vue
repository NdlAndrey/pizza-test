<template>
  <div class="card">
    <div class="card-header">
      Pizza List

      <button class="btn btn-primary btn-sm float-right" @click="">Create</button>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Ingredients</th>
          <th scope="col">Price</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in items">
          <th scope="row">{{ ++index }}</th>
          <td>{{ item.name }}</td>
          <td></td>
          <td>{{ item.price }}</td>
          <td>{{ item.date }}</td>
          <td>
            <button type="button" class="btn btn-primary btn-sm">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" @click="handlerDelete(item.route_delete)">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script>
  export default {
    name: "PizzaListComponent",

    props: {
      source: {
        type: String,
        required: true
      }
    },

    data() {
      return {
        items: []
      }
    },

    mounted() {
      this.handlerInit()
    },

    methods: {
      async handlerInit() {
        const {data} = await axios.get(this.source);

        this.items = data.data;
      },

      async handlerDelete(source) {
        const {data} = await axios.delete(source);

        let index = this.items.findIndex(item => item.id === data.id);
        this.items.splice(index, 1);
      }
    }

  };
</script>

<style scoped>

</style>
