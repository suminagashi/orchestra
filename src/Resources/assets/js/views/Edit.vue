<template>
    <div class="flex" id="app">
      <div class="h-screen w-full flex overflow-hidden">
        <EditContent />
      </div>
    </div>
</template>

<script>
import EditContent from '../components/EditContent';

export default {
  name: 'Edit',
  components: {
    EditContent
  },
};
</script>
