<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted } from 'vue'
import { useMutation, useQuery } from '@tanstack/vue-query'
import {
  orderCancelMutation,
  orderCompleteMutation,
  orderCreateMutation,
  ordersShowOptions,
} from '@/client/@tanstack/vue-query.gen.ts'
import useShoppingCart from '@/stores/useShoppingCart.ts'

const {
  data: orderData,
  error: createOrderError,
  isPending: createOrderIsPending,
  mutate: createOrder,
} = useMutation({
  ...orderCreateMutation(),
})
const {
  error: cancelOrderError,
  isPending: cancelOrderIsPending,
  mutate: cancel,
} = useMutation({
  ...orderCancelMutation(),
})
const {
  error: completeOrderError,
  isPending: completeOrderIsPending,
  mutateAsync: completeOrderAsync,
} = useMutation({ ...orderCompleteMutation() })

const maybeOrderId = computed(() => orderData.value?.data.id)

const {
  data: detailedOrderData,
  error: dataError,
  isLoading: dataIsLoading,
} = useQuery(() => ({
  ...ordersShowOptions({
    path: {
      orderId: maybeOrderId.value!,
    },
  }),
  enabled: maybeOrderId.value != null,
}))
const { items } = useShoppingCart()

onMounted(() => {
  createOrder({
    body: {
      items: items.map((i) => ({ extProductId: i.id })),
    },
  })
})
onBeforeUnmount(() => {
  if (!orderData.value) return
  cancel({
    body: {
      orderId: orderData.value.data.id,
    },
  })
})

const isPending = computed(
  () =>
    createOrderIsPending.value ||
    dataIsLoading.value ||
    cancelOrderIsPending.value ||
    completeOrderIsPending.value,
)
const error = computed(
  () =>
    createOrderError.value || dataError.value || cancelOrderError.value || completeOrderError.value,
)

const onCompleteOrder = () => {
  if (!orderData.value) return
  completeOrderAsync({
    body: {
      orderId: orderData.value.data.id,
    },
  })
}
</script>

<template>
  <div v-if="error">{{ error.message }}</div>
  <div v-if="isPending" class="flex justify-center items-center h-screen">
    <ProgressSpinner />
  </div>
  <div v-if="detailedOrderData" class="flex row gap-4 w-full">
    <div class="min-w-3/5 flex flex-col justify-between">
      <div>[Shipping info here]</div>
      <div class="">
        <Button
          :disabled="orderData?.data.id == null"
          @click="onCompleteOrder"
          class="w-full"
          size="large"
          label="Complete Order"
        />
      </div>
    </div>
    <div class="min-w-2/5 flex flex-col gap-2 px-8">
      <Card v-for="orderItem in detailedOrderData.data.orderItems" :key="orderItem.id">
        <template #content>
          <div class="flex justify-between items-center">
            <div class="w-1/2">
              <span class="font-bold capitalize">{{ orderItem.name }}</span>
            </div>
            <div class="w-1/2 flex justify-end items-center gap-2">
              <span class="font-bold">
                {{ orderItem.formattedPrice }}
              </span>
              <span> 1 </span>
            </div>
          </div>
        </template>
      </Card>
      <div class="flex flex-row justify-between items-center mt-4">
        <span class="font-bold">Total:</span>
        <span class="font-bold">{{ detailedOrderData.data.formattedSubTotal }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
