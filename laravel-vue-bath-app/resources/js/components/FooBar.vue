<template>
  <div id="app">
    <p>{{ message }}</p>
  </div>
</template>

<script>
  export default {
    name: 'FooBar',
    data() {
      return {
        message: "Hello Vue!!"
      }
    },
    props: {
      propSamplePrice: {
        type: Number,
      },
      endpoint: {
        type: String,
      },
    },
    methods: {
      async sampleUpdate() {
        const response = await axios.put(this.endpoint)
      },
    },
  }
</script>

<style></style>
