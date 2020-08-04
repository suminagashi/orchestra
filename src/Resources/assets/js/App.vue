<template>
    <div class="h-screen w-full flex overflow-hidden">
      <Content />
    </div>
</template>

<script>
import Content from './components/Content';

export default {
  name: 'App',
  components: {
    Content
  },
};
</script>
