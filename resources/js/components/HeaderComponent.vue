<template>
    <div>
        <md-toolbar class="md-primary" md-elevation="2">
            <h3 class="md-title" style="flex: 1">Blog Test</h3>

            <router-link :to="{ name: 'articles'}">
                <md-button>Articles</md-button>
            </router-link>
        </md-toolbar>
    </div>
</template>

<script>
    export default {
        name: "HeaderComponent.vue"
    }
</script>

<style scoped>

</style>