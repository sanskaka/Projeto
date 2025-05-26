<template>
  <div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">
      {{ task.id ? 'Editar Tarefa' : 'Nova Tarefa' }}
    </h2>

    <form @submit.prevent="handleSubmit">
      <div class="mb-4">
        <label class="block mb-1">Título</label>
        <input v-model="task.titulo" type="text" class="w-full border rounded p-2" required>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Descrição</label>
        <textarea v-model="task.descricao" class="w-full border rounded p-2"></textarea>
      </div>

      <div class="mb-4">
        <label class="block mb-1">Status</label>
        <select v-model="task.status" class="w-full border rounded p-2" required>
          <option value="pendente">Pendente</option>
          <option value="concluida">Concluída</option>
        </select>
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        {{ task.id ? 'Atualizar' : 'Criar' }}
      </button>

      <button type="button" @click="$emit('cancel')" class="ml-2 bg-gray-300 px-4 py-2 rounded">
        Cancelar
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive, toRefs, watch } from 'vue';

const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({ titulo: '', descricao: '', status: 'pendente' })
  }
});

const emits = defineEmits(['submit', 'cancel']);

const task = reactive({ ...props.modelValue });

// Atualiza quando props mudar
watch(() => props.modelValue, (newVal) => {
  Object.assign(task, newVal);
});

function handleSubmit() {
  emits('submit', task);
}
</script>