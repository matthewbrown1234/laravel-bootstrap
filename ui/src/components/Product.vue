<script setup lang="ts">
import type { ProductResource } from '@/client'

export type ProductProps = {
  product: ProductResource
}

defineProps<ProductProps>()
</script>

<template>
  <Card :title="product.name">
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
      <h3>{{ product.name }}</h3>
      <div class="font-bold">{{ product.price }}</div>
    </template>
    <template #footer>
      <Button rounded variant="outlined" icon="pi pi-plus" label="Add to Cart" />
    </template>
  </Card>
</template>

<style scoped></style>
