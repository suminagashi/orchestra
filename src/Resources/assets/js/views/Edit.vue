<template>
    <div class="flex" id="app">
      <div class="h-screen w-full flex overflow-hidden">
        <NavbarHome title="My admin"/>
        <EditContent />
      </div>
    </div>
</template>

<script>
import NavbarHome from '../components/ui/NavbarHome';
import EditContent from '../components/EditContent';

export default {
  name: 'Edit',
  components: {
    NavbarHome,
    EditContent
  },
};
</script>
