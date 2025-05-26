<template>
  <AppLayout :breadcrumbs="breadcrumbItems">
    <Head title="Tasks list" />

    <div class="p-6 rounded-lg shadow-md">
      <h1 class="text-2xl mb-4">Lista de Tarefas</h1>

      <table class="min-w-full">
        <thead>
          <tr>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Título</th>
            <th class="px-4 py-2 border">Descrição</th>
            <th class="px-4 py-2 border">Data de Criação</th>
            <th class="px-4 py-2 border">Data de Atualização</th>
            <th class="px-4 py-2 border">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id" class="hover:bg-gray-50">
            <td class="px-4 py-2 border">{{ task.status }}</td>
            <td class="px-4 py-2 border">{{ task.titulo }}</td>
            <td class="px-4 py-2 border">{{ task.descricao }}</td>
            <td class="px-4 py-2 border">{{ task.created_at }}</td>
            <td class="px-4 py-2 border">{{ task.updated_at }}</td>
            <td class="px-4 py-2 border">
              <button class="text-blue-500 hover:underline mr-2" @click="handleModal('edit', task.id)">
                Editar
              </button>
              <button class="text-red-500 hover:underline" @click="handleModal('delete', task.id)">
                Excluir
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="tasks.length === 0" class="text-gray-500 mt-4">
        Nenhuma tarefa encontrada.
      </div>

      <q-btn
        label="Cadastrar"
        color="primary"
        @click="handleModal('create', null)"
        :disable="carregando"
        class="mt-4"
      />
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { useQuasar } from 'quasar'
import { Head } from '@inertiajs/vue3'
import { defineProps, ref, onMounted } from 'vue'
import type { BreadcrumbItem } from '@/types'
import CadastroTask from '@/pages/Tasks/Cadastro.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios'

const $q = useQuasar()

const breadcrumbItems: BreadcrumbItem[] = [
  { title: 'Tasks list', href: '/tasks/' },
]

const carregando = ref(false)
const tasks = ref<any[]>([])

const props = defineProps({
  tasks: { type: Array, required: true }
})

onMounted(() => {
  buscar()
})

function buscar() {
  carregando.value = true
  axios.get(route('tasks.list'))
    .then(response => {
      tasks.value = response.data
    })
    .finally(() => {
      carregando.value = false
    })
}

function handleModal(mode: string, id: number | null) {
  $q.dialog({
    component: CadastroTask,
    html: true,
    componentProps: { mode, id }
  }).onDismiss(() => buscar())
}
</script>