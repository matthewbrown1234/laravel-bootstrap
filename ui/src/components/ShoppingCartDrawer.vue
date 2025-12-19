<script setup lang="ts">
import { computed, watch } from 'vue'
import useShoppingCart from '@/stores/useShoppingCart.ts'
import { productSearchMutation } from '@/client/@tanstack/vue-query.gen.ts'
import { useMutation } from '@tanstack/vue-query'
import type { ProductResource } from '@/client'
import { useRouter } from 'vue-router'

const visible = defineModel<boolean>('visible', { default: false })
const shoppingCart = useShoppingCart()

const { mutate, data, error, isPending } = useMutation({
  ...productSearchMutation(),
  onError: () => {},
})

watch([visible, shoppingCart], () => {
  if (!visible.value) {
    return
  }
  mutate({
    body: {
      ids: shoppingCart.items.map((i) => i.id),
    },
  })
})
const router = useRouter()

const cartProducts = computed(() =>
  shoppingCart.items.reduce((acc: Array<ProductResource & { quantity: number }>, cur) => {
    const foundProduct = data.value?.data.find((p) => p.id === cur.id)
    if (foundProduct) {
      return [
        ...acc,
        {
          ...foundProduct,
          quantity: cur.quantity,
        },
      ]
    }
    return acc
  }, []),
)
const onCheckout = () => {
  router.push({
    name: 'checkout',
  })
  visible.value = false
}
</script>

<template>
  <Drawer
    header="Shopping Cart"
    v-model:visible="visible"
    position="right"
    :showCloseIcon="false"
    class="md:w-100! lg:w-170!"
    block-scroll
  >
    <template v-if="isPending">
      <div class="flex justify-center">
        <ProgressSpinner />
      </div>
    </template>
    <template v-if="error">
      <div class="flex justify-center">An error occurred: {{ error?.message }}</div>
    </template>
    <template v-if="!error && !isPending && !cartProducts.length">
      <div class="flex justify-center">Your cart is empty</div>
    </template>
    <template v-if="!isPending && cartProducts.length">
      <div class="flex flex-col h-full justify-between">
        <div class="flex flex-col gap-2 overflow-y-auto">
          <Card v-for="(product, index) in cartProducts" :key="product.id">
            <template #content>
              <div class="flex justify-between items-center">
                <div class="w-1/2">
                  <span class="font-bold capitalize">{{ product.name }}</span>
                </div>
                <div class="w-1/2 flex justify-end items-center gap-2">
                  <span class="font-bold">
                    {{ product.formattedPrice }}
                  </span>
                  <span>
                    {{ product.quantity }}
                  </span>
                  <Button
                    icon="pi pi-times"
                    rounded
                    size="small"
                    severity="secondary"
                    variant="text"
                    @click="shoppingCart.removeByCartPosition(index)"
                  />
                </div>
              </div>
            </template>
          </Card>
        </div>
        <div class="flex flex-col justify-end border-t border-gray-200">
          <div class="flex flex-row justify-between items-center mt-4" v-if="cartProducts.length">
            <span>Subtotal ({{ cartProducts.length }} items)</span>
            <span class="font-bold">{{
              cartProducts.reduce((acc, cur) => acc + cur.price * cur.quantity, 0)
            }}</span>
          </div>
          <div class="mt-4">
            <Button @click="onCheckout" size="large" class="w-full" label="Checkout" />
          </div>
        </div>
      </div>
    </template>
  </Drawer>
</template>

<style scoped></style>
