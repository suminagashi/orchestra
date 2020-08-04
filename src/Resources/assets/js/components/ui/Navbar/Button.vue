<template >
  <router-link :to="link" v-if="isActive()">
  <li class="mt-8 shadow py-2 bg-white dark:bg-gray-200 rounded-lg -ml-4 shadow-xl hover:text-blue-600">
    <a :href="link" class="flex pl-4">
      <span
        class="ml-2 capitalize">
        {{ name }}
      </span>
    </a>
  </li>
  </router-link>
  <router-link :to="link" v-else>
  <li class="mt-8" >
    <a :href="link" class="flex hover:text-blue-600">
      <span
        class="ml-2 capitalize font-medium
        dark:text-gray-300">
        {{ name }}
      </span>
    </a>
  </li>
  </router-link>
</template>
<script>
export default {
  name: 'Button',
  props: ['name', 'link'],
  methods: {
    isActive(){
      if(this.name === this.$route.name){
        return true;
      }
      return false;
    }
  }
}
</script>
