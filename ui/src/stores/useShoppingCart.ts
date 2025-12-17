import { computed } from 'vue'
import { defineStore } from 'pinia'
import type { ProductResource } from '@/client'
import { useStorage } from '@vueuse/core'

export type ShoppingCartState = {
  cart: Array<ProductResource & { quantity: number }>
}

export const useShoppingCart = defineStore('counter', () => {
  const storage = useStorage<ShoppingCartState>(
    'cart',
    {
      cart: [],
    },
    localStorage,
    { mergeDefaults: true },
  )
  const count = computed(() => storage.value.cart.length)
  function add({ product, quantity = 1 }: { product: ProductResource; quantity?: number }) {
    storage.value.cart = [...storage.value.cart, { ...product, quantity }]
  }
  function removeByCartPosition(cartPosition: number) {
    storage.value.cart = storage.value.cart.filter((_, index) => index !== cartPosition)
  }

  return { count, removeByCartPosition, add }
})

export default useShoppingCart
