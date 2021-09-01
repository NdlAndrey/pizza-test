<template>
  <div class="card">
    <div class="card-header">
      Pizza List

      <button class="btn btn-primary btn-sm float-right" @click="modalOpen(null)">Create</button>
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
            <button type="button" class="btn btn-primary btn-sm" @click="modalOpen(item.id)">Edit</button>
            <button type="button" class="btn btn-danger btn-sm" @click="handlerDelete(item.route_delete)">Delete
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <!-- Vertically centered modal -->
    <b-modal v-model="modalShow"
             :title="modalTitle"
             @ok.prevent="handleSubmit"
             button-size="sm">
      <form>
        <div class="form-group">
          <label for="form-name" class="col-form-label">Name:</label>
          <input type="text"
                 class="form-control"
                 :class="Object.keys(responseErrors).includes('name') ? 'is-invalid': ''"
                 id="form-name" v-model="form.name">
        </div>

        <p class="text-center">Ingredients</p>
        <hr>
        <div class="form-group" v-for="(ingredient, index) in form.ingredients">
          <div class="row">
            <div class="col-md-7">
              <label :for="`form-name-${index}`" class="col-form-label col-form-label-sm">Name:</label>
              <select class="custom-select custom-select-sm" v-model="ingredient.ingredient_id">
                <option selected>Select ingredient</option>
                <option :value="value" v-for="(text, value) in ingredientOptions" v-text="text" />
              </select>

            </div>
            <div class="col-md-3">
              <label :for="`form-sort-${index}`" class="col-form-label col-form-label-sm">Sort:</label>
              <input type="text" class="form-control form-control-sm" :id="`form-sort-${index}`" v-model="ingredient.sort">
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <div class="btn-group mr-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary btn-sm" @click="addOption">+</button>
                <button type="button" class="btn btn-danger btn-sm" :disabled="index === 0" @click="deleteOption(index)">-</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </b-modal>
  </div>

</template>

<script>
  import { BButton, BModal, VBModal } from "bootstrap-vue";

  export default {
    name: "PizzaListComponent",

    components: {
      BButton,
      BModal
    },

    props: {
      source: {
        type: String,
        required: true
      }
    },

    data() {
      return {
        items: [],
        ingredientOptions: [],
        productId: null,
        responseErrors: {},

        modalTitle: 'Create Pizza',
        modalShow: false,
        form: {
          name: '',
          ingredients: []
        }
      };
    },

    mounted() {
      this.handlerInit();
    },


    methods: {
      // Method get table data
      async handlerInit() {
        const {data} = await axios.get(this.source);

        this.items = data.data;
        this.ingredientOptions = data.ingredients
      },

      // Method delete item by table
      handlerDelete(source) {
        axios.delete(source).then(response => {
          let index = this.items.findIndex(item => item.id === response.data.id);
          this.items.splice(index, 1);
        });
      },

      // Method open modal and set values to form
      modalOpen(id = null) {
        this.responseErrors = {};
        this.productId = id;
        let index = this.items.findIndex(item => item.id === id);
        this.modalTitle = index !== -1 ? 'Edit Pizza' : 'Create Pizza';

        this.form = {
          name: index !== -1 ? this.items[index].name : '',
          ingredients:  index !== -1 ? this.items[index].ingredients : [{ingredient_id: null, sort: 0}],
        }

        this.modalShow = true;
      },

      // Method add row for ingredients
      addOption() {
        this.form.ingredients.push({ingredient_id: null, sort: 0});
      },

      // Method delete ingredient
      deleteOption(index) {
        this.form.ingredients.splice(index, 1);
      },

      handleSubmit() {
        let index = this.items.findIndex(item => item.id === this.productId);
        console.log(this.productId);

        axios({
          method: this.productId ? 'put' : 'post',
          url: `/admin/pizza/` + (this.productId || ''),
          data: this.form
        }).then(response => {
          if (this.productId) {
            this.items[index] = response.data.data
          } else {
            this.items.unshift(response.data.data)
          }
          this.modalShow = false;
        }).catch(errors => {
          if (errors.response.status === 422)
            this.responseErrors = errors.response.data.errors;
          else
            this.responseErrors.message = errors.message;
        })
      }
    }

  };
</script>

<style>
  .modal-backdrop {
    opacity: .5!important;
  }
</style>
