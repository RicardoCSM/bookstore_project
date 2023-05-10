<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';
import Footer from '@/Components/App/LayoutComponents/Footer.vue';

import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Contact" />

    <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
        <NavBar />
        <main class="m-1">
            <div class="max-w-6xl py-12 mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white rounded-md shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Contact Us
                        </h3>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500">
                            If you have any questions, comments or feedback, please feel free to contact us using the
                            form below or connect with us on social media.
                        </p>
                    </div>
                    <div class="px-4 py-5 border-t border-gray-200 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Email
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    info@thenightowlbookstore.com
                                </dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Address
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    1234 Main St.<br>
                                    Anytown, USA 12345
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Connect with Us
                        </h3>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500">
                            Follow us on social media to stay up-to-date on the latest news and events from The Night
                            Owl Bookstore.
                        </p>
                        <div class="flex mt-3">
                            <a href="https://github.com/ricardoCSM" target="_blank" class="mr-3">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/ricardo-costa-a1a421244//" target="_blank">
                                <i class="fab fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <Footer class="relative bottom-0 left-0 z-20 w-full mt-6 md:fixed" />
    </div>
</template>s