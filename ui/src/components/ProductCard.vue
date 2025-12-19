<script setup lang="ts">
import type { ProductResource } from '@/client'
import { useRouter } from 'vue-router'

export type ProductProps = {
  product: ProductResource
}

export type ProductEmits = {
  (e: 'addToCart', args: { product: ProductResource }): void
}

defineProps<ProductProps>()
const emits = defineEmits<ProductEmits>()
const router = useRouter()
</script>

<template>
  <Card
    @click="router.push({ name: 'product', params: { id: product.id } })"
    class="cursor-pointer"
    :title="product.name"
  >
    <template #content>
      <div>
        <Image alt="Image">
          <template #image>
            <img
              class="rounded-lg"
              src="https://primefaces.org/cdn/primevue/images/galleria/galleria10.jpg"
              alt="image"
            />
          </template>
        </Image>
      </div>
      <h3 class="capitalize">{{ product.name }}</h3>
      <div class="font-bold">{{ product.formattedPrice }}</div>
    </template>
    <template #footer>
      <Button
        @click.stop="() => emits('addToCart', { product })"
        rounded
        variant="outlined"
        icon="pi pi-plus"
        label="Add to Cart"
        class="w-full"
      />
    </template>
  </Card>
</template>

<style scoped></style>
