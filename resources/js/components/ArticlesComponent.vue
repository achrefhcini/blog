<template>
    <div class="wrapper">
    <div class="md-layout section">
        <template v-for="article of articles">
            <div v-bind:key="article.id" class="md-layout-item md-size-33 md-small-size-100">
                <md-card>
                    <md-card-media>
                        <img v-bind:src="article.image" alt="People">
                    </md-card-media>

                    <md-card-header>
                        <div class="md-title">{{article.titre}}</div>
                        <div class="md-subhead">{{article.text}}</div>
                    </md-card-header>

                    <md-card-expand>
                        <md-card-actions md-alignment="space-between">
                            <div>
                                <md-button>Modifier</md-button>
                            </div>

                            <md-card-expand-trigger>
                                <md-button>Supprimer</md-button>
                            </md-card-expand-trigger>
                        </md-card-actions>

                        <md-card-expand-content>
                            <md-card-content>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio itaque ea, nostrum odio. Dolores, sed accusantium quasi non, voluptas eius illo quas, saepe voluptate pariatur in deleniti minus sint. Excepturi.
                            </md-card-content>
                        </md-card-expand-content>
                    </md-card-expand>
                </md-card>
            </div>
        </template>
    </div>
    </div>
</template>

<script>
    import { localApi,localUploadPath} from '../variables'
    import axios from "axios";

    export default {
        name: "ArticlesComponent.vue",
        data () {
            return {
                articles: []
            }
        },
        mounted()  {
            axios
                .get(localApi+"articles")
                .then(response => {
                    (this.articles = response.data.data)
                    console.log(this.articles)
                })
        }
    }
</script>

<style scoped>
.md-card{
    margin: 30px;
}
</style>