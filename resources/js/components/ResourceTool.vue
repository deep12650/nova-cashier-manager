<template>
    <div>
        <loading-view :loading="loading">
            <div class="flex items-center mb-3"><h1 class="flex-no-shrink text-90 font-normal text-2xl">Manage Subscription</h1> </div>

            <div class="card mb-6 py-3 px-6">
                <p class="text-90" v-if="!subscription">
                    User has no subscription.
                </p>

                <div class="flex border-b border-40" v-if="subscription">
                    <div class="w-1/4 py-4"><h4 class="font-normal text-80">Plan</h4></div>
                    <div class="w-3/4 py-4"><p class="text-90">
                        {{subscription.plan}}
                        ({{subscription.plan_amount / 100}} {{subscription.plan_currency}} / {{subscription.plan_interval}})
                    </p></div>
                </div>

                <!-- ... (other template code) ... -->
            </div>
        </loading-view>
    </div>
</template>

<script>
import { reactive, toRefs, onMounted } from 'vue';
import axios from 'axios';

export default {
    props: ['resourceName', 'resourceId', 'field'],

    setup(props) {
        const state = reactive({
            loading: true,
            user: null,
            subscription: null,
        });

        const basePath = Nova.config.base;

        const loadUserData = () => {
            axios.get(`/nova-cashier-tool-api/user/${props.resourceId}/?brief=true`)
                .then(response => {
                    state.user = response.data.user;
                    state.subscription = response.data.subscription;
                    state.loading = false;
                });
        };

        onMounted(() => {
            loadUserData();
        });

        return {
            ...toRefs(state),
            basePath,
            loadUserData,
        };
    },
};
</script>

<style>
    /* Scopes Styles */
</style>
