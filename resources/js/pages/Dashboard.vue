<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';

function logout() {
    router.post('/logout');
}
</script>

<template>
    <Head title="Dashboard — North" />

    <main class="min-h-screen bg-slate-950 px-6 py-12 text-white">
        <div class="mx-auto max-w-5xl">
            <header class="flex items-center justify-between border-b border-slate-800 pb-6">
                <h1 class="text-3xl font-semibold tracking-tight">
                    north<span class="text-indigo-400">.</span>
                </h1>

                <button
                    type="button"
                    class="text-sm text-slate-400 transition hover:text-white"
                    @click="logout"
                >
                    Cerrar sesión
                </button>
            </header>

            <section class="py-16">
                <p class="mb-3 text-sm font-medium text-indigo-400">
                    PANEL DE CONTROL
                </p>

                <h2 class="text-3xl font-semibold">
                    Bienvenido a North.
                </h2>

                <p class="mt-4 text-slate-400">
                    Tu espacio de trabajo está listo.
                    Pronto podrás gestionar tus proyectos, tareas y equipos.
                </p>
            </section>
        </div>
    </main>
</template>
