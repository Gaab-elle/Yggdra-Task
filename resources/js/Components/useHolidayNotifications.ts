import { ref, computed } from 'vue';

export function useHolidayNotifications() {
    const isLoading = ref(false);
    const error = ref<string | null>(null);
    const holidayData = ref<any>(null);

    const checkHoliday = async (date: string) => {
        if (!date) return;
        
        isLoading.value = true;
        error.value = null;
        
        try {
            const response = await fetch(`/api/holiday-check?date=${date}`);
            const data = await response.json();
            
            if (response.ok) {
                holidayData.value = data;
            } else {
                error.value = data.message || 'Erro ao verificar feriado';
            }
        } catch (err) {
            error.value = 'Erro de conexão';
        } finally {
            isLoading.value = false;
        }
    };

    const formatDate = (date: string) => {
        return new Date(date).toLocaleDateString('pt-BR');
    };

    return {
        isLoading,
        error,
        holidayData,
        checkHoliday,
        formatDate
    };
}
