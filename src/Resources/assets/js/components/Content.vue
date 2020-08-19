<template>
  <div
    class="flex-1 flex flex-col  dark:bg-gray-700 transition
    duration-500 ease-in-out overflow-y-auto">
    <div class="grid grid-cols-4 gap-4 mt-10 my-10 mx-10">
      <div class="col-span-3">
        <h2 class="text-2xl font-semibold dark:text-gray-400">
          Users
        </h2>
      </div>
      <div class="col-span-1">
        <SearchBar class="w-full"/>
      </div>
    </div>
    <div class="flex flew-row-reverse mx-10 mb-2">
      <Widget data="150" change="6" desc="new users last week" color="blue"/>
      <Widget data="13" change="0" desc="% of benefits" color="indigo"/>
      <Widget data="103" change="-10" desc="dollars per minute" color="teal"/>
    </div>
    <div class="mx-10 my-2">
      <RowHeader />
      <Row
        name="louis harang"
        login="narah"
        status="working"
        projects="orchestra"
        roles="Admin"
      />

      <Row
        name="hugo knorr"
        login="vodkhard"
        status="working"
        projects="orchestra"
        roles="Dev"
      />

      <FullRow
        name="hugo knorr"
        login="vodkhard"
        status="working"
        projects="orchestra"
        roles="Developer"
      />
      <FullRow
        name="louis harang"
        login="narah"
        status="working"
        projects="orchestra"
        roles="Developer"
      />
    </div>
  <div class="flew content-center flex-wrap w-full">
    <Pagination />
  </div>
  </div>
</template>
<script>
  import Row from './ui/Row';
  import FullRow from './ui/FullRow';
  import RowHeader from './ui/RowHeader';
  import SearchBar from './ui/SearchBar';
  import Widget from './ui/Widget';
  import Pagination from './ui/Pagination';

  export default {
    name: 'Content',
    components: {
      Row,
      FullRow,
      Pagination,
      RowHeader,
      SearchBar,
      Widget,
    },
  };
</script>
