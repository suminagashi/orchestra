<template>
  <div class="flex rounded-lg">
    <span class="text-sm border border-2 rounded-l px-4 py-2 bg-gray-300 whitespace-no-wrap">{{label}}:</span>
    <input name="field_name" class="border border-2 rounded-r px-4 py-2 w-full" type="text" :placeholder="placeholder" />
</div>
</template>
<script>
export default {
  name: 'Input',
  props: ['label', 'placeholder'],
}
</script>
