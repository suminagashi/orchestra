<template>
    <div class="flex" id="app">

      <div class="h-screen w-full flex overflow-hidden">
        <Navbar title="My admin"/>
        <main
          class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
          duration-500 ease-in-out overflow-y-auto">
          <div class="flex flex-row-reverse">
            <SearchBar class="mx-10 my-2 mt-10" />
          </div>
          <div class="flex flex-row">
            <h2 class="flex text-2xl font-semibold mx-10 dark:text-gray-400">
              All Users
            </h2>
          </div>
          </nav>
          <div class="flex flew-row-reverse mx-10 my-2">
            <Widget data="150" change="6" desc="new users last week" color=""/>
            <Widget data="13" change="0" desc="% of benefits" color=""/>
            <Widget data="103" change="-10" desc="dollars per minute" color=""/>
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
              class="mt-20"
              name="louis harang"
              login="narah"
              status="working"
              projects="orchestra"
              roles="Admin"
            />

            <FullRow
              name="hugo knorr"
              login="vodkhard"
              status="working"
              projects="orchestra"
              roles="Developer"
            />
            <FullRow
              name="hugo knorr"
              login="vodkhard"
              status="working"
              projects="orchestra"
              roles="Developer"
            />


          </div>
        <div class="flew content-center flex-wrap w-full">
          <Pagination />
        </div>
        </main>

      </div>
    </div>
</template>

<script>
import Row from './ui/Row';
import FullRow from './ui/FullRow';
import RowHeader from './ui/RowHeader';
import Navbar from './ui/Navbar';
import SearchBar from './ui/SearchBar';
import Widget from './ui/Widget';
import Pagination from './ui/Pagination';

export default {
  name: 'App',
  components: {
    Row,
    FullRow,
    Pagination,
    RowHeader,
    Navbar,
    SearchBar,
    Widget,
  },
};
</script>
