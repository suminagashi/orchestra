<template >
  <li
    v-if="active"
    class="mt-8 shadow py-2 bg-white dark:bg-gray-200 rounded-lg
    -ml-4 shadow-xl hover:text-blue-600">
    <a :href="link" class="flex pl-4">
      <span
        class="ml-2 capitalize">
        {{ name }}
      </span>
    </a>
  </li>
  <li class="mt-8" v-else>
    <a :href="link" class="flex hover:text-blue-600">
      <span
        class="ml-2 capitalize font-medium
        dark:text-gray-300">
        {{ name }}
      </span>
    </a>
  </li>
</template>
<script>
export default {
  name: 'Button',
  props: ['name', 'link', 'active']
}
</script>
