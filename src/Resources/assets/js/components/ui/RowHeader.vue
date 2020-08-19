<template>
  <div
      class="mt-2 grid grid-cols-11 gap-4 px-4 py-4 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer">

    <div
        class="ml-4 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-3">
      <span>name</span>
    </div>

    <div
        class="ml-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-2">
      <span>login</span>
    </div>


    <div
        class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-1">
      <span>project</span>
    </div>

    <div
        class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-1">
      <span>role</span>
    </div>

    <div
        class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-2">
      <span>status</span>
    </div>

    <div
        class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-2">
      <span>actions</span>
    </div>
  </div>
</template>
<script>
import Checkbox from './Checkbox';

export default {
  name: 'RowHeader',
  components: {
    Checkbox,
  }
}
</script>
