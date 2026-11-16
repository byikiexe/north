<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const email = ref('');
const password = ref('');
const remember = ref(false);

const errors = ref<Record<string, string>>({});
const processing = ref(false);

function submit() {
    router.post('/login', {
        email: email.value,
        password: password.value,
        remember: remember.value,
    }, {
        onStart: () => {
            processing.value = true;
            errors.value = {};
        },
        onError: (validationErrors) => {
            errors.value = validationErrors;
        },
        onFinish: () => {
            processing.value = false;
        },
    });
}
</script>

<template>
    <Head title="Iniciar sesión — North" />

    <main class="flex min-h-screen items-center justify-center bg-slate-950 px-6 text-white">
        <div class="w-full max-w-sm">
            <div class="mb-10">
                <h1 class="text-4xl font-semibold tracking-tight">
                    north<span class="text-indigo-400">.</span>
                </h1>
                <p class="mt-3 text-sm text-slate-400">
                    Organiza proyectos, tareas y equipos en un solo lugar.
                </p>
            </div>

            <h2 class="mb-6 text-xl font-medium">
                Iniciar sesión
            </h2>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label for="email" class="mb-2 block text-sm text-slate-300">
                        Correo electrónico
                    </label>
                    <input
                        id="email"
                        v-model="email"
                        type="email"
                        autocomplete="email"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm outline-none focus:border-indigo-400"
                        placeholder="nombre@ejemplo.com"
                    />
                    <p v-if="errors.email" class="mt-2 text-sm text-red-400">
                        {{ errors.email }}
                    </p>
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm text-slate-300">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        v-model="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm outline-none focus:border-indigo-400"
                        placeholder="Introduce tu contraseña"
                    />
                    <p v-if="errors.password" class="mt-2 text-sm text-red-400">
                        {{ errors.password }}
                    </p>
                </div>

                <div class="flex items-center justify-between gap-3 text-sm">
                    <label class="flex items-center gap-2 text-slate-400">
                        <input
                            v-model="remember"
                            type="checkbox"
                            class="accent-indigo-500"
                        />
                        Recordarme
                    </label>

                    <Link href="/forgot-password" class="text-indigo-400 hover:text-indigo-300">
                        ¿Olvidaste tu contraseña?
                    </Link>
                </div>

                <button
                    type="submit"
                    :disabled="processing"
                    class="w-full rounded-lg bg-indigo-500 px-4 py-3 text-sm font-medium text-white transition hover:bg-indigo-400 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ processing ? 'Iniciando sesión...' : 'Entrar' }}
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-400">
                ¿Todavía no tienes una cuenta?
                <Link href="/register" class="font-medium text-indigo-400 hover:text-indigo-300">
                    Regístrate
                </Link>
            </p>
        </div>
    </main>
</template>
