<template>
<ul class="flex justify-center mt-10 mb-10">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-500 rounded-lg  ">
            <a class="flex items-center font-bold" href="#">
                <span class="mx-1">Previous</span>
            </a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-blue-400 hover:shadow hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">1</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-blue-400 hover:shadow hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">2</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-blue-400 hover:shadow hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">3</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-blue-400 hover:shadow hover:text-gray-200 rounded-lg">
            <a class="flex items-center font-bold" href="#">
                <span class="mx-1">Next</span>
            </a>
        </li>
    </ul>
</template>
<script>
export default {
  name: 'Pagination',
}
</script>
