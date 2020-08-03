<template>
  <button
    class="mt-8 flex items-center justify-between py-3 px-2 text-white
    dark:text-gray-200 hover:bg-blue-600 bg-blue-400 dark:bg-blue-500 rounded-lg shadow">

    <span class="ml-2">{{name}}</span>
    <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
      <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
    </svg>
  </button>
</template>
<script>

export default {
  name: 'Action',
  props: ['name']
};

</script>
