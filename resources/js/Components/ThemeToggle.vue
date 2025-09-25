<template>
    <button 
        @click="toggleDark"
        class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-md transition-all duration-200 backdrop-blur-sm"
        :title="isDark ? 'Modo Claro' : 'Modo Escuro'"
    >
        <!-- Sol (modo claro) -->
        <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">
            <path d="M12 2a1 1 0 011 1v2a1 1 0 11-2 0V3a1 1 0 011-1zm0 16a4 4 0 100-8 4 4 0 000 8zm8-5a1 1 0 100-2h-2a1 1 0 100 2h2zM6 12a1 1 0 100-2H4a1 1 0 100 2h2zm11.657-6.657a1 1 0 010 1.414L16.414 8.0a1 1 0 11-1.414-1.414l1.243-1.243a1 1 0 011.414 0zM9 16.414a1 1 0 10-1.414-1.414L6.343 16.243A1 1 0 107.757 17.657L9 16.414zM17.657 16.243a1 1 0 10-1.414 1.414l1.243 1.243a1 1 0 001.414-1.414l-1.243-1.243zM7.757 7.343A1 1 0 106.343 5.929L5.1 7.171A1 1 0 106.514 8.586l1.243-1.243z"/>
        </svg>
        <!-- Lua (modo escuro) -->
        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor">
            <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"/>
        </svg>
    </button>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const isDark = ref(false);

const applyThemeClass = () => {
    const root = document.documentElement;
    if (isDark.value) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
    console.log('Theme applied:', isDark.value ? 'dark' : 'light');
};

const toggleDark = () => {
    console.log('Toggle dark mode clicked, current state:', isDark.value);
    isDark.value = !isDark.value;
    localStorage.setItem('theme:dark', isDark.value ? '1' : '0');
    applyThemeClass();
    console.log('New state:', isDark.value);
};

const initTheme = () => {
    const savedTheme = localStorage.getItem('theme:dark');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    console.log('Initializing theme:', { savedTheme, prefersDark });
    
    if (savedTheme !== null) {
        isDark.value = savedTheme === '1';
    } else {
        isDark.value = prefersDark;
    }
    
    applyThemeClass();
};

onMounted(() => {
    initTheme();
});
</script>
