<template>
  <div>
    {{ tables }}
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default{
 name:"componenteB",

computed:{
  ...mapState(["tables"])
}
}
</script>
