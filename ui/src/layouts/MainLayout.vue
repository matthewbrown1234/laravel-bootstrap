<script setup lang="ts">
import { ref } from 'vue'
import useShoppingCart from '@/stores/useShoppingCart.ts'

const brand = ref(`Matt's Products`)
const store = useShoppingCart()
</script>

<template>
  <header class="pr-0">
    <Toolbar>
      <template #start>
        <Button class="mr-2" severity="secondary"> {{ brand }} </Button>
      </template>

      <template #center>
        <IconField>
          <InputIcon>
            <i class="pi pi-search" />
          </InputIcon>
          <InputText placeholder="Search" disabled />
        </IconField>
      </template>

      <template #end>
        <Button icon="pi pi-user" aria-label="User" variant="text" />
        <OverlayBadge :value="store.count" severity="info" class="mr-2">
          <Button icon="pi pi-shopping-cart" aria-label="Shopping Cart" variant="text" />
        </OverlayBadge>
      </template>
    </Toolbar>
  </header>
  <main class="px-6">
    <slot />
  </main>
</template>

<style scoped></style>
