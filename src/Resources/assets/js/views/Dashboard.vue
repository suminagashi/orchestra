<template>
    <div class="flex" id="app">
      <div class="h-screen w-full flex overflow-hidden">
        <HomeContent />
      </div>
    </div>
</template>

<script>
import HomeContent from '../components/HomeContent';

export default {
  name: 'Dashboard',
  components: {
    HomeContent
  },
};
</script>
