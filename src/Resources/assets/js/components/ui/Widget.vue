<template>
            <div
              class="mt-2 flex px-4 py-4 hover:bg-gray-200 bg-white
              dark:bg-gray-600 shadow rounded-lg cursor-pointer ml-2 mr-2 text-center">
              <div>
                  <div>
                      <p v-if="this.getWidgetChangeType() === 'up'" class="flex items-center justify-end text-green-500 text-md">
                          <span class="font-bold">{{change}}%</span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg>
                      </p>
                      <p v-else-if="this.getWidgetChangeType() === 'down'" class="flex items-center justify-end text-red-500 text-md">
                          <span class="font-bold">{{change}}%</span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 9a1 1 0 012 0v8a1 1 0 01-1 1h-8a1 1 0 010-2h5.59L13 10.41l-3.3 3.3a1 1 0 01-1.4 0l-6-6a1 1 0 011.4-1.42L9 11.6l3.3-3.3a1 1 0 011.4 0l6.3 6.3V9z"/></svg>
                      </p>
                      <p v-else class="flex items-center justify-end text-gray-500 text-md">
                          <span class="font-bold">{{change}}%</span>
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg>
                      </p>
                  </div>
                  <p class="text-3xl font-semibold text-gray-800">{{data}}</p>
                  <p class="text-lg text-gray-500">{{desc}}</p>
              </div>
            </div>
</template>
<script>
export default {
  name: 'Widget',
  props: ['data', 'change', 'desc', 'color'],
  methods: {
    getWidgetChangeType () {
      if(this._props.change > 0){
        return 'up';
      }
      if(this._props.change < 0){
        return 'down';
      }
      return false
    }
  },
}
</script>
