<script>
export default {
  props: [
    'questions',
  ]
}
</script>

<template>
  <table class="table table-separated table-hover table-responsive-sm">
    <thead>
    <tr>
      <th>#</th>
      <th>Question</th>
      <th>Type</th>
      <th class="text-right w-100px">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(question, index) in questions">
      <th scope="row">{{index + 1}}</th>
      <td>{{question.translation.title}}</td>
      <td>{{question.type}}</td>
      <td class="text-right table-actions">
        <a class="table-action tx-gray-500 mg-r-10" href="javascript:void(0)"><i class="fa fa-pencil"></i></a>
        <a class="table-action tx-gray-500 mg-r-10" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
        <a class="table-action tx-gray-500 mg-r-10" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
        <span class="dropdown-toggle tx-gray-500" data-toggle="dropdown"></span>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-book"></i> Details</a>
          <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-link"></i> Add file</a>
          <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-bar-chart"></i> Performance</a>
        </div>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>
