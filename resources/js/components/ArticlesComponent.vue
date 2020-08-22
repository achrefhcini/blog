<template>

    <div class="wrapper">
        <md-button  @click="showDialogAdd = true" class="md-fab md-fab-bottom-right"  aria-label="Ajouter un article">
            <md-icon>add</md-icon>
        </md-button>
        <div>
            <br/>
            <br/>
            <div class="section container filter" >

                <md-chip @click='filtrer("all")' class="md-primary" md-clickable>Tous</md-chip>

                <template v-for="categorie of categories">
                    <md-chip @click="filtrer(categorie.slug)" class="md-primary" md-clickable>{{categorie.name}}</md-chip>
                </template>

            </div>
        </div>
    <div class="md-layout section">

        <template v-for="article of articles">
            <div v-bind:key="article.id" class="md-layout-item md-size-33 md-small-size-100">
                <md-card>
                    <router-link
                            :to="{ name: 'article', params: { id: article.id } }"
                    >
                    <md-card-media>
                        <img v-bind:src="article.image" alt="People">
                    </md-card-media>
                    </router-link>


                    <md-card-header>
                        <router-link
                                :to="{ name: 'article', params: { id: article.id } }"
                        >
                        <div class="md-title">{{article.titre}}</div>
                        </router-link>

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
                    <md-dialog-title>Ajouter un article</md-dialog-title>

                    <div class="container">
                        <md-field>
                            <label>Titre</label>
                            <md-input v-model="newArticle.titre"></md-input>
                        </md-field>

                        <md-field>
                            <label>Image Url</label>
                            <md-input v-model="newArticle.image"></md-input>
                        </md-field>

                        <div class="md-layout-item" v-if="categories!= null">
                            <md-field>
                                <md-select v-model="newArticle.category_id" name="category" id="cat"  placeholder="Categorie">
                                    <md-option v-for="cat in categories" v-bind:key="cat.id" :value="cat.id">
                                        {{cat.name}}
                                    </md-option>

                                </md-select>
                            </md-field>
                        </div>

                        <md-field>
                            <label>Text</label>
                            <md-textarea v-model="newArticle.text"></md-textarea>
                        </md-field>

                    </div>

                    <md-dialog-actions>
                        <md-button class="md-primary" @click="showDialogAdd = false">Fermer</md-button>
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
                categories : null,
                newArticle : {
                    "image" : "",
                    "titre" : "",
                    "text" : "",
                    "category_id" : "",
                }
            }
        },
        methods: {
            filtrer: function (slug){
            axios.get(localApi+"articles/"+slug)
                    .then(response => {
                        (this.articles = response.data)

                    })
            },
            ajouter: function() {
                axios
                    .post(localApi+"article/",this.newArticle)
                    .then(response => {
                        console.log(response.data)
                        this.alertContent = response.data.msg ;
                        if(response.data.status===200){
                            this.showDialogAdd = false,
                                this.resultAlert = true;
                            this.articles.push(response.data.article)
                        }
                        else {
                            this.resultAlert = true
                        }
                    })
            }
        },
        mounted()  {
            axios
                .get(localApi+"articles/all")
                .then(response => {
                    (this.articles = response.data)
                })
            axios
                .get(localApi+"catgories")
                .then(response => {
                    (this.categories = response.data)

                })
        }
    }
</script>

<style scoped>
.md-card{
    margin: 30px;
}
.filter{
    display: flex;
    justify-content: center;
}
.md-fab-bottom-right{
    position: fixed !important;
    right: 15px; /* Add this and change value to set the margin you want */
}
</style>