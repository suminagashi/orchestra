<template>
            <div
              class="mt-2 flex px-4 py-4 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
              <!-- Card -->

              <div class="flex justify-between">
                <!-- Left side -->
                <div
                  class="ml-4 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>name</span>
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{name}}
                  </span>
                </div>

                <div
                  class="ml-12 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>login</span>
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{login}}
                  </span>

                </div>

              </div>

              <div class="flex">
                <!-- Rigt side -->

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>project</span>
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{projects}}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>role</span>
                  <span class="text-red-600 dark:text-red-400">
                    {{roles}}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400">
                  <span>status</span>
                  <span class="mt-2 text-black dark:text-green-200">
                    {{status}}
                  </span>
                </div>


              </div>

            </div>
</template>
<script type="text/javascript">
export default {
  name: 'FullRow',
  props: ['name', 'status', 'roles', 'login', 'projects'],
}
</script>
