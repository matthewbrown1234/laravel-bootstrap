import { computed } from 'vue'
import { defineStore } from 'pinia'
import type { ProductResource } from '@/client'
import { useStorage } from '@vueuse/core'

export type ShoppingCartState = {
  cart: Array<{ id: string; quantity: number }>
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
  const cart = computed(() => storage.value.cart)
  const count = computed(() => storage.value.cart.length)

  function add({ product, quantity = 1 }: { product: ProductResource; quantity?: number }) {
    storage.value.cart = [...storage.value.cart, { id: product.id, quantity }]
  }
  function removeByCartPosition(cartPosition: number) {
    storage.value.cart = storage.value.cart.filter((_, index) => index !== cartPosition)
  }

  return { count, removeByCartPosition, add, items: cart }
})

export default useShoppingCart
