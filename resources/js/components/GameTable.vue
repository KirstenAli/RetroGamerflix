<script>
import EditGame from "@/components/EditGame.vue";

export default {
    name: "GameTable",
    components: {EditGame},
    props:['games'],
    data(){
        return{
            game: {}
        }
    },
    methods:{
        setGame(game){
            this.game = game;
        }
    },
}
</script>

<template>
    <div class="card mt-4">
        <div class="card-header">
            Games List
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Game ID</th>
                    <th>Genre</th>
                    <th>Description</th>
                    <th>Game Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Display game details in rows -->
                <tr v-for="game in games">
                    <td>{{game.id}}</td>
                    <td>{{game.genre}}</td>
                    <td>{{game.description}}</td>
                    <td><img :src="`/game/thumbnail/${game.id}`" alt="" width="50"></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm netflix-btn" data-bs-toggle="modal" data-bs-target="#editGameModal" @click="setGame(game)">Edit</button>
                    </td>
                </tr>
                <!-- Add more rows dynamically for each game -->
                </tbody>
            </table>
        </div>
    </div>

    <edit-game :game="game"></edit-game>
</template>

<style scoped>

</style>
