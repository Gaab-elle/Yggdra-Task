<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-900 dark:text-white leading-tight">
        {{ t('settings.title') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          
          <!-- Configurações Gerais -->
          <div class="bg-white dark:bg-white/10 backdrop-blur border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">{{ t('settings.general') }}</h3>
              
              <div class="space-y-4">
                <!-- Idioma -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.language') }}
                  </label>
                  <select 
                    v-model="settings.language"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="pt">Português</option>
                    <option value="en">English</option>
                    <option value="es">Español</option>
                  </select>
                </div>

                <!-- Tema -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.theme') }}
                  </label>
                  <select 
                    v-model="settings.theme"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="light">{{ t('settings.light_theme') }}</option>
                    <option value="dark">{{ t('settings.dark_theme') }}</option>
                    <option value="auto">{{ t('settings.auto_theme') }}</option>
                  </select>
                </div>

                <!-- Notificações -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.notifications"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.enable_notifications') }}
                    </span>
                  </label>
                </div>

                <!-- Email de notificações -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.email_notifications"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.email_notifications') }}
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Configurações de Tarefas -->
          <div class="bg-white dark:bg-white/10 backdrop-blur border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">{{ t('settings.tasks') }}</h3>
              
              <div class="space-y-4">
                <!-- Tarefas por página -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.tasks_per_page') }}
                  </label>
                  <select 
                    v-model="settings.tasksPerPage"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                </div>

                <!-- Lembretes automáticos -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.auto_reminders"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.auto_reminders') }}
                    </span>
                  </label>
                </div>

                <!-- Ordenação padrão -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.default_sort') }}
                  </label>
                  <select 
                    v-model="settings.defaultSort"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="created_at">{{ t('settings.sort_created') }}</option>
                    <option value="due_date">{{ t('settings.sort_due_date') }}</option>
                    <option value="priority">{{ t('settings.sort_priority') }}</option>
                    <option value="title">{{ t('settings.sort_title') }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Configurações de Privacidade -->
          <div class="bg-white dark:bg-white/10 backdrop-blur border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">{{ t('settings.privacy') }}</h3>
              
              <div class="space-y-4">
                <!-- Perfil público -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.public_profile"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.public_profile') }}
                    </span>
                  </label>
                </div>

                <!-- Compartilhar estatísticas -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.share_stats"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.share_stats') }}
                    </span>
                  </label>
                </div>

                <!-- Dados de uso -->
                <div>
                  <label class="flex items-center">
                    <input 
                      type="checkbox" 
                      v-model="settings.usage_data"
                      class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:ring-blue-500"
                    >
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      {{ t('settings.usage_data') }}
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Configurações de Sistema -->
          <div class="bg-white dark:bg-white/10 backdrop-blur border border-gray-200 dark:border-white/10 text-gray-900 dark:text-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">{{ t('settings.system') }}</h3>
              
              <div class="space-y-4">
                <!-- Timezone -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.timezone') }}
                  </label>
                  <select 
                    v-model="settings.timezone"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="America/Sao_Paulo">Brasília (GMT-3)</option>
                    <option value="America/New_York">Nova York (GMT-5)</option>
                    <option value="Europe/London">Londres (GMT+0)</option>
                    <option value="Europe/Madrid">Madrid (GMT+1)</option>
                    <option value="Asia/Tokyo">Tóquio (GMT+9)</option>
                  </select>
                </div>

                <!-- Formato de data -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.date_format') }}
                  </label>
                  <select 
                    v-model="settings.dateFormat"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                    <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                  </select>
                </div>

                <!-- Formato de hora -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ t('settings.time_format') }}
                  </label>
                  <select 
                    v-model="settings.timeFormat"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="24">{{ t('settings.24_hour') }}</option>
                    <option value="12">{{ t('settings.12_hour') }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Botões de Ação -->
        <div class="mt-6 flex justify-end space-x-4">
          <button
            @click="resetSettings"
            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:ring-2 focus:ring-blue-500"
          >
            {{ t('settings.reset') }}
          </button>
          <button
            @click="saveSettings"
            :disabled="saving"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
          >
            {{ saving ? t('settings.saving') : t('settings.save') }}
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useLocale } from '@/Components/useLocale';

const { t } = useLocale();

const saving = ref(false);

const settings = ref({
  language: 'pt',
  theme: 'auto',
  notifications: true,
  email_notifications: true,
  tasksPerPage: 25,
  auto_reminders: true,
  defaultSort: 'created_at',
  public_profile: false,
  share_stats: false,
  usage_data: true,
  timezone: 'America/Sao_Paulo',
  dateFormat: 'DD/MM/YYYY',
  timeFormat: '24'
});

const loadSettings = () => {
  // Carregar configurações do localStorage ou API
  const savedSettings = localStorage.getItem('yggdratask_settings');
  if (savedSettings) {
    settings.value = { ...settings.value, ...JSON.parse(savedSettings) };
  }
};

const saveSettings = async () => {
  saving.value = true;
  
  try {
    // Salvar no localStorage
    localStorage.setItem('yggdratask_settings', JSON.stringify(settings.value));
    
    // Aqui você pode adicionar uma chamada para API se necessário
    // await axios.post('/api/settings', settings.value);
    
    // Aplicar configurações imediatamente
    applySettings();
    
    // Mostrar notificação de sucesso
    console.log('Configurações salvas com sucesso!');
    
  } catch (error) {
    console.error('Erro ao salvar configurações:', error);
  } finally {
    saving.value = false;
  }
};

const resetSettings = () => {
  if (confirm(t('settings.confirm_reset'))) {
    settings.value = {
      language: 'pt',
      theme: 'auto',
      notifications: true,
      email_notifications: true,
      tasksPerPage: 25,
      auto_reminders: true,
      defaultSort: 'created_at',
      public_profile: false,
      share_stats: false,
      usage_data: true,
      timezone: 'America/Sao_Paulo',
      dateFormat: 'DD/MM/YYYY',
      timeFormat: '24'
    };
    localStorage.removeItem('yggdratask_settings');
    applySettings();
  }
};

const applySettings = () => {
  // Aplicar tema
  if (settings.value.theme === 'dark') {
    document.documentElement.classList.add('dark');
  } else if (settings.value.theme === 'light') {
    document.documentElement.classList.remove('dark');
  } else {
    // Auto - seguir preferência do sistema
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (prefersDark) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }
};

onMounted(() => {
  loadSettings();
});
</script>
