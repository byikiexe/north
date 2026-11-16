<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    email: '',
});

const page = usePage();

const status = computed(() => page.props.status as string | undefined);

function submit() {
    form.post('/forgot-password', {
        onFinish: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <Head title="Recuperar contraseña — North" />

    <main class="flex min-h-screen items-center justify-center bg-slate-950 px-6 py-12 text-white">
        <div class="w-full max-w-sm">
            <div class="mb-10">
                <h1 class="text-4xl font-semibold tracking-tight">
                    north<span class="text-indigo-400">.</span>
                </h1>

                <p class="mt-3 text-sm text-slate-400">
                    Gestión de proyectos, tareas y equipos.
                </p>
            </div>

            <h2 class="mb-3 text-xl font-medium">
                Recuperar contraseña
            </h2>

            <p class="mb-8 text-sm leading-6 text-slate-400">
                Introduce tu correo electrónico y te enviaremos
                un enlace para restablecer tu contraseña.
            </p>

            <div
                v-if="status"
                role="status"
                class="mb-6 rounded-lg border border-emerald-800 bg-emerald-950/40 p-4 text-sm text-emerald-300"
            >
                {{ status }}
            </div>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label for="email" class="mb-2 block text-sm text-slate-300">
                        Correo electrónico
                    </label>

                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white outline-none focus:border-indigo-400"
                        placeholder="nombre@ejemplo.com"
                    />

                    <p
                        v-if="form.errors.email"
                        class="mt-2 text-sm text-red-400"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-indigo-500 px-4 py-3 text-sm font-medium text-white transition hover:bg-indigo-400 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ form.processing ? 'Enviando...' : 'Enviar enlace de recuperación' }}
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-400">
                ¿Recuerdas tu contraseña?
                <Link href="/login" class="font-medium text-indigo-400 hover:text-indigo-300">
                    Volver al inicio de sesión
                </Link>
            </p>
        </div>
    </main>
</template>
