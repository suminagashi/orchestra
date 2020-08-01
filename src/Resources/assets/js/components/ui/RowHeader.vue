<template>
            <div
              class="mt-2 flex px-6 py-4 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
              <!-- Card -->

              <div class="flex justify-between">
                <!-- Left side -->
                <Checkbox />
                <div
                  class="ml-6 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>name</span>
                </div>

                <div
                  class="ml-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>login</span>
                </div>

              </div>

              <div class="flex">
                <!-- Rigt side -->

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>project</span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>role</span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>status</span>
                </div>


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
