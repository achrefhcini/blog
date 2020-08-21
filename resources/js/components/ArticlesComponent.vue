<template>

    <div class="wrapper">
        <md-button  @click="showDialogAdd = true" class="md-fab md-fab-bottom-right"  aria-label="Ajouter un article">
            <md-icon>add</md-icon>
        </md-button>
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
                                <router-link
                                        :to="{ name: 'article', params: { id: article.id } }"
                                >
                                <md-button>Lire plus</md-button>
                                </router-link>
                            </div>



                        </md-card-actions>


                    </md-card-expand>
                </md-card>
            </div>
            <div>
                <md-dialog :md-active.sync="showDialogAdd">
                    <md-dialog-title>Modification</md-dialog-title>

                    <div class="container">
                        <md-field>
                            <label>Titre</label>
                            <md-input v-model="newArticle.titre"></md-input>
                        </md-field>

                        <md-field>
                            <label>Image Url</label>
                            <md-input v-model="newArticle.image"></md-input>
                        </md-field>

                        <md-field>
                            <label>Text</label>
                            <md-textarea v-model="newArticle.text"></md-textarea>
                        </md-field>

                    </div>

                    <md-dialog-actions>
                        <md-button class="md-primary" @click="showDialogEdit = false">Fermer</md-button>
                        <md-button class="md-primary" @click="ajouter()">Sauvgarder</md-button>
                    </md-dialog-actions>
                </md-dialog>



            </div>

            <div>
                <md-dialog-alert
                        :md-active.sync="resultAlert"
                        :md-content="alertContent"
                        md-confirm-text="Ok" />
            </div>
        </template>
    </div>
    </div>
</template>

<script>
    import { localApi} from '../variables'
    import axios from "axios";

    export default {
        name: "ArticlesComponent.vue",
        data () {
            return {
                showDialogAdd : false,
                resultAlert : false,
                alertContent : "",
                articles: [],
                newArticle : {
                    "image" : "",
                    "titre" : "",
                    "text" : "",
                }
            }
        },
        methods: {
            ajouter: function () {
                axios
                    .post(localApi+"article/",this.newArticle)
                    .then(response => {
                        console.log(response.data)
                        this.alertContent = response.data.msg ;
                        if(response.data.status===200){
                            this.showDialogAdd = false,
                                this.resultAlert = true;
                            setTimeout(()=>{
                                this.$router.push('/articles')

                            },3000)
                        }
                        else {
                            this.resultAlert = true
                        }
                    })
            }
        },
        mounted()  {
            axios
                .get(localApi+"articles")
                .then(response => {
                    (this.articles = response.data)
                    console.log(this.articles)
                })
        }
    }
</script>

<style scoped>
.md-card{
    margin: 30px;
}
.md-fab-bottom-right{
    position: fixed !important;
    right: 15px; /* Add this and change value to set the margin you want */
}
</style>