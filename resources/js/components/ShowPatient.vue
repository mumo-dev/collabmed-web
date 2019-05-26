<template>
<table class="table">
  
    <tr>
      <th>#ID:</th>
      <td>{{ patient.id}}</td>
    </tr>
    <tr>
      <th>Name:</th>
      <td>{{ patient.name}} </td>
    </tr>
    <tr>
      <th>Age:</th>
      <td>{{ patient.age}}</td>
    </tr>
    <tr>
      <th>Gender:</th>
      <td>{{ patient.gender}}</td>
    </tr>

  </table>
</template>

<script>
export default {
  props:['patient']
}
</script>
