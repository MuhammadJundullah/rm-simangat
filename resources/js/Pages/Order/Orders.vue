<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <div v-for="item in data" :key="item.id">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dd class="font-medium text-gray-900">ID Pesananan = {{ item.id }}</dd>
          <dd class="font-medium text-gray-900">Atas nama = {{ item.user.name }}</dd>
          <dd class="text-gray-900 sm:col-span-2">Status Pesanan = {{ item.order_status }}</dd>
          <dd class="text-gray-900 font-bold">Total bayar = Rp {{ item.total_harga }},-</dd>

          <div class="flex gap-3 py-3">
            <div class="flex gap-2">
              <!-- Batalkan Pesanan Button -->
              <Link
                :href="route(rute[1])"
                :data="{ id: item.id }"
                as="button"
                method="post"
              >
                <PrimaryButton
                  :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status)"
                  :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status) ? 'cursor-not-allowed opacity-50' : ''"
                >
                  Batalkan Pesanan
                </PrimaryButton>
              </Link>

              <!-- Rincian Pesanan Button -->
              <Link
                :href="route(rute[0])"
                :data="{ id: item.id }"
                as="button"
                method="get"
              >
                <PrimaryButton>Rincian Pesanan</PrimaryButton>
              </Link>
            </div>

            <!-- Admin Controls -->
            <div v-if="userRole === 'admin'" class="flex gap-3">
              <!-- Proses Pesanan Button -->
              <Link
                :href="route(rute[2])"
                :data="{ id: item.id }"
                as="button"
                method="post"
              >
                <PrimaryButton
                  :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status)"
                  :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status) ? 'cursor-not-allowed opacity-50' : ''"
                >
                  Proses Pesanan
                </PrimaryButton>
              </Link>

              <!-- Pesanan Selesai Button -->
              <Link
                :href="route(rute[3])"
                :data="{ id: item.id }"
                as="button"
                method="post"
              >
                <PrimaryButton
                  :disabled="item.order_status !== 'Pesanan diproses'"
                  :class="item.order_status !== 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
                >
                  Pesanan Selesai
                </PrimaryButton>
              </Link>
            </div>
          </div>

          <!-- Admin: Hapus Pesanan Button -->
          <div v-if="userRole === 'admin'" class="flex gap-3 sm:pl-20">
            <Link
              v-if="['Pesanan selesai', 'Dibatalkan pembeli', 'Dibatalkan penjual'].includes(item.order_status)"
              :href="route(rute[4])"
              :data="{ id: item.id }"
              as="button"
              method="post"
            >
              <PrimaryButton class="bg-red-600 hover:bg-red-700">
                Hapus data pesanan
              </PrimaryButton>
            </Link>
          </div>
        </div>
      </div>
    </dl>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';

export default {
  components: {
    PrimaryButton,
    Link
  },
  props: {
    data: {
      required: true
    },
    rute: {
      required: true
    }
  },
  computed: {
    userRole() {
      return usePage().props.auth.user.role;
    }
  }
}
</script>
