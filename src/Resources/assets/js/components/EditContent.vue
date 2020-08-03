<template>
  <main
    class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
    duration-500 ease-in-out overflow-y-auto">
    <div class="grid grid-cols-4 gap-4 my-10 mx-10">
      <div class="col-span-3">
        <h2 class="text-2xl font-semibold dark:text-gray-400">
          Edit user
          <span class="text-lg font-normal text-grey-400">#2</span>
        </h2>
      </div>
      <div class="col-span-1">
        <SearchBar class="w-full"/>
      </div>
    </div>
    <div class="mx-10 my-2">
      <div class="mt-2 px-4 py-4 justify-between bg-white
              dark:bg-gray-600 shadow-xl rounded-lg">
      </div>
    </div>
  </main>
</template>
<script>
  import Row from './ui/Row';
  import FullRow from './ui/FullRow';
  import RowHeader from './ui/RowHeader';
  import SearchBar from './ui/SearchBar';
  import Widget from './ui/Widget';
  import Input from './ui/Input';
  import Pagination from './ui/Pagination';

  export default {
    name: 'EditContent',
    components: {
      Input,
      Row,
      FullRow,
      Pagination,
      RowHeader,
      SearchBar,
      Widget,
    },
  };
</script>
