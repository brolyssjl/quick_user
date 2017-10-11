<template>
</template>

<script>
    export default {
        mounted() {
          this.launchAlert()
        },
        props: ['message'],
        methods: {
          launchAlert: function(){
            if (this.message != '') {
              Materialize.toast(`${this.message}`, 5000, 'rounded')
            }
          }
        }
    }
</script>
