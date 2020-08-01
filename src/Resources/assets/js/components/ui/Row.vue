<template>
            <div
              class="mt-2 flex px-6 py-4 hover:bg-gray-200 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
              <!-- Card -->
              <div class="flex justify-between">
                <Checkbox class="mt-1"/>
                <!-- Left side -->
                <input type="checkbox" class="appearance-none checked:bg-gray-900">
                <div
                  class="ml-4 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ name }}
                  </span>
                </div>

                <div
                  class="ml-12 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ login }}
                  </span>

                </div>

              </div>

              <div class="flex">
                <!-- Rigt side -->

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ projects }}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ roles }}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span class="mt-2 text-green-400 dark:text-green-200">
                    {{ status }}
                  </span>
                </div>

              </div>

            </div>
</template>
<script type="text/javascript">
import Checkbox from './Checkbox';
export default {
  name: 'Row',
  props: ['name', 'status', 'roles', 'login', 'projects'],
  components: {
    Checkbox,
  }
}
</script>
