<script setup lang="ts">
import Product from '@/components/Product.vue'
import { useQuery } from '@pinia/colada'
import { productsIndexQuery } from '@/client/@pinia/colada.gen'
import ProductSkeleton from '@/components/ProductSkeleton.vue'

const abortController = new AbortController()

const { data, error, isLoading, state } = useQuery(
  productsIndexQuery({
    signal: abortController.signal,
    query: {
      perPage: 10,
    },
  }),
)
</script>

<template>
  <section>
    <h2>Products</h2>
    <div
      class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xxl:grid-cols-5"
    >
      <template v-if="isLoading"><ProgressSpinner /></template>
      <template v-if="isLoading">
        <ProductSkeleton />
      </template>
      <template v-else-if="!isLoading" v-for="product in data?.data" :key="index">
        <Product :product="product" />
      </template>
    </div>
  </section>
</template>

<style scoped></style>
