<template>
  <div class="flex" id="app">
    <div class="h-screen w-full flex overflow-hidden">
      <Navbar title="My admin"/>
      <router-view />
    </div>
  </div>
</template>

<script>
import Navbar from './components/ui/Navbar';

export default {
  name: 'App',
  components: {
    Navbar,
  }
};
</script>
