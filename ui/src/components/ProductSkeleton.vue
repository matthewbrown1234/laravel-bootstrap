<script setup lang="ts"></script>

<template>
  <Card>
    <template #content>
      <div>
        <Skeleton height="19rem"></Skeleton>
      </div>
      <Skeleton height="1rem" class="mt-1"></Skeleton>
      <Skeleton height="1rem" class="mt-1"></Skeleton>
    </template>
    <template #footer>
      <Skeleton width="8rem" height="3rem"></Skeleton>
    </template>
  </Card>
</template>

<style scoped></style>
