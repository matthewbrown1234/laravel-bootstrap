<script setup lang="ts">
import Product from '@/components/Product.vue'

const products = Array(50).fill({ id: 0 })
</script>

<template>
  <section>
    <h2>Products</h2>
    <div
      class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xxl:grid-cols-5"
    >
      <template v-for="product in products" :key="index">
        <Product :product="product" />
      </template>
    </div>
  </section>
</template>

<style scoped></style>
