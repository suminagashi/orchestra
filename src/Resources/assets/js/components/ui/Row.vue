<template>
            <div
              class="mt-2 grid grid-cols-11 gap-4 px-4 py-4 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer">

                <div
                  class="ml-4 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-3">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ name }}
                  </span>
                </div>

                <div
                  class="ml-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-2">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ login }}
                  </span>

                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-1">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ projects }}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-1">
                  <span class="mt-2 text-black dark:text-gray-200">
                    {{ roles }}
                  </span>
                </div>

                <div
                  class="mr-16 flex flex-col capitalize text-gray-600
                  dark:text-gray-400 col-span-2">
                  <span class="mt-2 text-green-400 dark:text-green-200">
                    {{ status }}
                  </span>
                </div>

                <div class="col-span-1 flex">
                <div
                 class="flex capitalize text-gray-600
                 dark:text-gray-400">
                 <button class="text-blue-600 font-bold py-2 px-4 rounded-lg w-18 h-10 text-center">
                   <svg fill="none" class="w-6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                 </button>
               </div>

               <div
                 class="flex capitalize text-gray-600
                 dark:text-gray-400 ml-3">
                 <button class="text-orange-600 font-bold py-2 px-4 rounded-lg w-18 text-center">
                   <svg fill="none" class="w-6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                 </button>
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
