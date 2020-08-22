<template>
    <div  class="main main-raised">
        <div class="section section-text pb-0">
            <div class="container">
                <div class="md-layout">

                    <div class="section md-layout-item md-size-80 md-small-size-100 mx-auto">
                        <div class="md-layout" v-if="article!= null">
                            <div class="md-layout-item md-size-100 md-small-size-100 text-center">
                                <br />
                                <br />
                                <img v-if="article"
                                        class="img-raised rounded img-fluid"
                                        alt="Raised Image"
                                        v-bind:src="article.image"
                                />
                                <br/>
                                <br/>
                                <div class="md-layout-item md-size-66 md-small-size-100 mx-auto">
                                    <h3 class="blog-title">{{ article.titre}}</h3>
                                </div>
                                <br />
                                <br />
                                <div class="" v-html="article.text">
                                </div>
                                <br />
                                <br />
                                    <md-button @click="showDialogEdit = true"  class="md-round md-primary">Modifier</md-button>
                                    <md-button @click="showDialogDelete = true" class="md-round md-accent">Supprimer</md-button>
                            </div>

                            <div>
                                <md-dialog :md-active.sync="showDialogDelete">
                                    <md-dialog-title>Vous voulez supprimer cet article ?</md-dialog-title>
                                    <div class="container">
                                        Si vous supprimer cet article, vous ne pouvez pas le récupérer dans le future
                                    </div>
                                    <md-dialog-actions>
                                        <md-button class="md-accent" @click="supprimer(article.id)">Confirmer</md-button>

                                        <md-button class="md-primary" @click="showDialogDelete = false">Annuler</md-button>
                                    </md-dialog-actions>
                                </md-dialog>

                            </div>


                            <div>
                                <md-dialog :md-active.sync="showDialogEdit">
                                    <md-dialog-title>Modification</md-dialog-title>

                                    <div class="container" v-if="article!= null">
                                        <md-field>
                                            <label>Titre</label>
                                            <md-input v-model="article.titre"></md-input>
                                        </md-field>

                                        <md-field>
                                            <label>Image Url</label>
                                            <md-input v-model="article.image"></md-input>
                                        </md-field>


                                        <div class="md-layout-item" v-if="categories!= null">
                                            <md-field>
                                                <md-select v-model="article.category_id" name="category" id="cat"  placeholder="Categorie">
                                                    <md-option v-for="cat in categories" v-bind:key="cat.id" :value="cat.id">
                                                        {{cat.name}}
                                                    </md-option>

                                                </md-select>
                                            </md-field>
                                        </div>

                                        <md-field>
                                            <label>Text</label>
                                            <md-textarea v-model="article.text"></md-textarea>
                                        </md-field>

                                    </div>

                                    <md-dialog-actions>
                                        <md-button class="md-primary" @click="showDialogEdit = false">Fermer</md-button>
                                        <md-button class="md-primary" @click="modifier()">Sauvgarder</md-button>
                                    </md-dialog-actions>
                                </md-dialog>



                            </div>

                            <div>
                                <md-dialog-alert
                                        :md-active.sync="resultAlert"
                                        :md-content="alertContent"
                                        md-confirm-text="Ok" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { localApi} from '../variables'
    import axios from "axios";
    export default {
        name: "ArticleComponent.vue",
        data() {
            return {
                showDialogDelete : false,
                showDialogEdit : false ,
                article : null,
                resultAlert : false,
                alertContent : "",
                categories : null,
            }
        },
        mounted()  {
            axios
                .get(localApi+"article/"+this.$route.params.id)
                .then(response => {
                    (this.article = response.data)
                })

            axios
                .get(localApi+"catgories")
                .then(response => {
                    (this.categories = response.data)

                })
        },
        methods: {
            supprimer: function (id) {
              axios
                  .delete(localApi+"article/"+this.$route.params.id)
                  .then(response => {
                      this.alertContent = response.data.msg ;
                      if(response.data.status===200){
                          this.showDialogDelete = false,
                          this.resultAlert = true;
                          setTimeout(()=>{
                              this.$router.push('/articles')

                          },3000)
                      }
                      else {
                          this.resultAlert = true
                      }
                  })
            },
            modifier: function () {
                axios
                    .put(localApi+"article/"+this.$route.params.id,this.article)
                    .then(response => {
                        console.log(response.data)
                        this.alertContent = response.data.msg ;
                        if(response.data.status===200){
                            this.showDialogEdit = false,
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
        }
    }
</script>

<style scoped>
    .md-dialog-container{
        width: 600px;
        max-width : unset !important;
    }
</style>