<template>
    <div class="flex" id="app">
      <div class="h-screen w-full flex overflow-hidden">
        <NavbarHome title="My admin"/>
        <HomeContent />
      </div>
    </div>
</template>

<script>
import NavbarHome from '../components/ui/NavbarHome';
import HomeContent from '../components/HomeContent';

export default {
  name: 'Dashboard',
  components: {
    NavbarHome,
    HomeContent
  },
};
</script>
