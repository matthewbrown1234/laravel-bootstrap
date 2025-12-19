<script setup lang="ts">
import { useQuery } from '@tanstack/vue-query'
import { productsShowOptions } from '@/client/@tanstack/vue-query.gen.ts'
import { computed } from 'vue'
import useShoppingCart from '@/stores/useShoppingCart.ts'
export type ProductPageProps = {
  id: string
}
const props = defineProps<ProductPageProps>()

const { isPending, data } = useQuery({
  ...productsShowOptions({
    path: {
      product: props.id,
    },
  }),
})

const product = computed(() => data.value?.data)
const cart = useShoppingCart()
</script>

<template>
  <div v-if="isPending"><ProgressSpinner /></div>
  <div v-if="!isPending && product" class="grid grid-cols-2 gap-4">
    <div class="flex justify-center items-center h-48 md:h-64 lg:h-130 w-full">
      <img
        src="https://primefaces.org/cdn/primevue/images/galleria/galleria10.jpg"
        alt="image"
        class="h-full object-contain rounded-lg shadow-lg"
      />
    </div>
    <div class="flex flex-col justify-between">
      <div class="flex flex-col gap-2">
        <div>
          <h2 class="capitalize">{{ product.name }}</h2>
          <div class="font-light">{{ product.description }}</div>
        </div>
        <div class="font-bold">{{ product.formattedPrice }}</div>
      </div>
      <div>
        <Button
          @click="() => product && cart.add({ product })"
          rounded
          class="w-full mt-4"
          variant="outlined"
          icon="pi pi-plus"
          label="Add to Cart"
        />
      </div>
    </div>
  </div>
</template>

<style scoped></style>
