<script setup lang="ts">
export type ProductProps = {
  product: any
}

const props = defineProps<ProductProps>()
</script>

<template>
  <Card title="Product Name">
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
      <h3>Product Name</h3>
      <div class="font-bold">$11.99</div>
    </template>
    <template #footer>
      <Button rounded variant="outlined" icon="pi pi-plus" label="Add to Cart" />
    </template>
  </Card>
</template>

<style scoped></style>
