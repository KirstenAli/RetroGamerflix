<script>
import UploadForm from "@/components/UploadForm.vue";
import GameTable from "@/components/GameTable.vue";
import * as utils from "../utils.js";
export default {
    name: "AdminPanel",
    components: {GameTable, UploadForm},
    data(){
        return{
            games:[],
            newGame: {id:0},
            genres:[]
        }
    },

    methods:{
        addNewGame(game){
            this.games.push(game);
        },

        async deleteGame(gamePos) {
            const gameId = this.games[gamePos].id;

            let response = await utils.sendData(`/admin/game/destroy/${gameId}`, 'DELETE', true);

            if(response)
                this.games.splice(gamePos, 1);
        }
    },

    async mounted() {
        this.games = await utils.fetchJSON('/game/all');
        this.genres = await utils.fetchJSON('/admin/game/genres');
    },
}

</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add New Game
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="card-body padding">
                        <upload-form @post-event="addNewGame" :game="newGame" :genres="genres" formName="addForm" url="/admin/game/store"></upload-form>
                    </div>
                </div>
            </div>
        </div>

        <game-table :games="games" :genres="genres" @delete-event="deleteGame"></game-table>

    </div>

</template>

<style scoped>
.btn-link{
    color: #e50914;
}
</style>
