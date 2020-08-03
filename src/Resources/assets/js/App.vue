<template>
    <div class="flex" id="app">
      <div class="h-screen w-full flex overflow-hidden">
        <Navbar title="My admin"/>
        <Content />
      </div>
    </div>
</template>

<script>
import Navbar from './components/ui/Navbar';
import Content from './components/Content';

export default {
  name: 'App',
  components: {
    Navbar,
    Content
  },
};
</script>
