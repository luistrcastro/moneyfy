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
    const response = await this.$api('categories').index()
    this.data = response.data;
    const response2 = await this.$api('base_categories').index()
    this.allData = response2.data;
  },

  methods:{
    async fetch(){
      const response = await this.$api('categories').show(925830557);
      this.obj = response.data;
    },
    async create(){
      const response = await this.$api('categories').post({
        name: 'New Category',
        slug: 'new_category',
        color: 'black',
        icon: 'check',
        description: 'something',
      });
      this.newObj = response.data;
    },
    async deleteItem(){
      const response = await this.$api('categories').delete(925830557);
      this.newObj = response.data;
    },
    async update(){
      const response = await this.$api('categories').update(925830557, {
        name: 'Old Category',
        slug: 'old_category',
        color: 'black',
        icon: 'check',
        description: 'something',
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
