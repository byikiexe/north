<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.post('/register', {
        onSuccess: () => {
            form.reset('password', 'password_confirmation');
        },
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
}
</script>

<template>
    <Head title="Crear cuenta — North" />

    <main class="flex min-h-screen items-center justify-center bg-slate-950 px-6 py-12 text-white">
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
                Crear una cuenta
            </h2>

            <form class="space-y-5" @submit.prevent="submit">
                <div>
                    <label for="name" class="mb-2 block text-sm text-slate-300">
                        Nombre
                    </label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white outline-none focus:border-indigo-400"
                        placeholder="Tu nombre"
                    />
                    <p v-if="form.errors.name" class="mt-2 text-sm text-red-400">
                        {{ form.errors.name }}
                    </p>
                </div>

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
                    <p v-if="form.errors.email" class="mt-2 text-sm text-red-400">
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm text-slate-300">
                        Contraseña
                    </label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white outline-none focus:border-indigo-400"
                        placeholder="Introduce una contraseña"
                    />
                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-400">
                        {{ form.errors.password }}
                    </p>
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm text-slate-300">
                        Confirmar contraseña
                    </label>
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white outline-none focus:border-indigo-400"
                        placeholder="Repite tu contraseña"
                    />
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-indigo-500 px-4 py-3 text-sm font-medium text-white transition hover:bg-indigo-400 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    {{ form.processing ? 'Creando cuenta...' : 'Crear cuenta' }}
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-400">
                ¿Ya tienes una cuenta?
                <Link href="/login" class="font-medium text-indigo-400 hover:text-indigo-300">
                    Inicia sesión
                </Link>
            </p>
        </div>
    </main>
</template>
