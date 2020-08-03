<template>
    <div class="mt-8">
      <h2
        class="mt-4 text-xl dark:text-gray-300 font-extrabold text-center capitalize">
        {{ name }}
      </h2>
      <span class="text-sm dark:text-gray-300">
        <p class="font-semibold text-blue-600 dark:text-blue-300 text-center">
          {{ role }}
        </p>
      </span>
    </div>
</template>
<script>

export default {
  name: 'ConnectedUser',
  props: ['name', 'role']
};

</script>
