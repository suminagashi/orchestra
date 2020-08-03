<template>
  <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">

    <div class="flex flex-row items-center justify-center pb-2">
      <span class="text-lg font-semibold capitalize dark:text-gray-300">
        {{title}}
      </span>
    </div>

    <ConnectedUser name="Louis Harang" role="Admin" />

    <Action name="Add user" />

    <ul class="mt-2 text-gray-600">
      <Button name="dashboard" link="#" />
      <Button name="users" link="#" :active="true" />
      <Button name="calendar" link="#" />
      <Button name="tasks" link="#" />
    </ul>

    <div class="mt-auto flex items-center text-red-700 hover:text-red-800 dark:text-red-400">
      <a href="#home" class="flex items-center">
        <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
          <path
            d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 012
            2v2h-2V4H5v16h9v-2h2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V4a2 2
            0 012-2h9z"></path>
        </svg>
        <span class="ml-2 capitalize font-medium">log out</span>
      </a>

    </div>
  </nav>
</template>
<script>
import Button from './Navbar/Button';
import Action from './Navbar/Action';
import ConnectedUser from './Navbar/ConnectedUser';

export default {
  name: 'Navbar',
  props: ['title'],
  components: {
    Button,
    Action,
    ConnectedUser
  }
};
</script>
