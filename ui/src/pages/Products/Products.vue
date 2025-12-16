<script setup lang="ts">
import Product from '@/components/Product.vue'
import ProductSkeleton from '@/components/ProductSkeleton.vue'
import { useInfiniteScroll } from '@vueuse/core'
import { useInfiniteQuery } from '@tanstack/vue-query'
import { productsIndexInfiniteOptions } from '@/client/@tanstack/vue-query.gen.ts'
import { computed } from 'vue'

const abortController = new AbortController()

const { data, error, isLoading, hasNextPage, fetchNextPage, isFetchingNextPage } = useInfiniteQuery(
  {
    ...productsIndexInfiniteOptions({
      signal: abortController.signal,
      query: {
        perPage: 500,
      },
    }),
    getNextPageParam: (lastPage) => {
      // Using your Laravel pagination structure
      if (lastPage.meta.current_page < lastPage.meta.last_page) {
        return lastPage.meta.current_page + 1
      }
      return undefined
    },
    initialPageParam: 1,
  },
)

// Flatten all pages into a single product array
const allProducts = computed(() => data.value?.pages.flatMap((page) => page.data))

const { reset } = useInfiniteScroll(
  window,
  () => {
    if (hasNextPage.value && !isFetchingNextPage.value) {
      fetchNextPage()
    }
  },
  {
    distance: 100,
    canLoadMore: (_) => {
      return true
    },
  },
)
</script>

<template>
  <section>
    <h2>Products</h2>
    <div>
      <template v-if="error">An error occurred: {{ error?.message }}</template>
      <template v-if="isFetchingNextPage"><ProgressSpinner /></template>
      <template v-show="isLoading">
        <ProductSkeleton />
      </template>
      <template v-if="!isLoading">
        <div
          class="grid gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xxl:grid-cols-5"
        >
          <div v-for="product in allProducts" :key="product.id">
            <Product :product="product" />
          </div>
        </div>
      </template>
    </div>
  </section>
</template>

<style scoped></style>
