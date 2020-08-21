<template>
    <div>
        <app-header></app-header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--transition name="fade"-->
                    <router-view></router-view>
                    <!--/transition-->
                </div>
            </div>
        </div>
        <app-footer></app-footer>

    </div>
</template>

<script>
    import Header from './HeaderComponent'

    import Footer from './FooterComponent'

    export default {
        name: "AppComponent.vue",
        components: {
            'app-header': Header,
            'app-footer': Footer
        },
    }
</script>

<style scoped>

</style>