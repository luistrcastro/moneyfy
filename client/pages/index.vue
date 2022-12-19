<template>
  <div>
    <h1>I am the index page, accessible only if you logged in</h1>
    <v-btn @click="fetch">fetch </v-btn>
    <v-btn @click="create">create </v-btn>
    <v-btn @click="update">update </v-btn>
    <v-btn @click="deleteItem">delete </v-btn>
    <v-btn @click="restore">restore </v-btn>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  data(){
    return{
      obj: null,
      data: null,
      allData: [],
      newObj: null,
      restoredObj: null,
    }
  },

  async mounted(){
    const response = await this.$api('transactions').index()
    this.data = response.data;
  },

  methods:{
    async fetch(){
      const response = await this.$api('transactions').show(this.data[0].id);
      this.obj = response.data;
    },
    async create(){
      const response = await this.$api('transactions').post({
        amount: 119.74,
        category_id:376385244,
        date:"2022-12-04",
        description:"cupiditate cum consequuntur dolor sit molestiae",
        duplication_checked:false,
        is_computed:true,
        label:"repellat",
        parent_transaction_id:null,
        system_generated:false,
      });
      this.newObj = response.data;
    },
    // async create(){
    //   const response = await this.$api('categories').post({
    //     name: 'New Category',
    //     slug: 'new_category',
    //     color: 'black',
    //     icon: 'check',
    //     description: 'something',
    //   });
    //   this.newObj = response.data;
    // },
    async deleteItem(){
      const response = await this.$api('transactions').delete(this.data[0].id);
      this.newObj = response.data;
    },
    async update(){
      const response = await this.$api('transactions').update(this.data[0].id, {
        ...this.data[0],
        label: 'New Label',
      });
      this.newObj = response.data;
    },
    async restore(){
      const response = await this.$api('categories/restore/925830557').post();
      this.restoredObj = response.data;
    }
  }
}
</script>
