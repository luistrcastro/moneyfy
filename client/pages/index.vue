<template>
  <div>
    <h1>I am the index page, accessible only if you logged in</h1>
    <v-btn @click="fetch">fetch </v-btn>
    <v-btn @click="create">create </v-btn>
    <v-btn @click="update">update </v-btn>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  data(){
    return{
      obj: null,
      data: null,
      newObj: null,
    }
  },

  async mounted(){
    const response = await this.$api('categories').index()
    this.data = response.data;
    const response2 = await this.$api('base_categories').index()
    console.log(response2)
  },

  methods:{
    async fetch(){
      const response = await this.$api('categories').show(1479262290);
      this.obj = response.data;
    },
    async create(){
      const response = await this.$api('categories').post({
        // user_id: 713293223,
        name: 'New Category',
        slug: 'new_category',
        color: 'black',
        icon: 'check',
        description: 'something',
      });
      this.newObj = response.data;
    },
    async delete(){
      const response = await this.$api('categories').delete(1139950057);
      this.newObj = response.data;
    },
    async update(){
      const response = await this.$api('categories').update(1139950057, {});
      this.newObj = response.data;
    }
  }
}
</script>
