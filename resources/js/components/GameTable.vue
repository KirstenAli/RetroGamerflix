<script>
import EditGame from "@/components/EditGame.vue";
import {initModal} from "../utils.js";

let editModal;

export default {
    name: "GameTable",
    components: {EditGame},
    emits: ['delete-event', 'search-event'],
    props:['games', 'genres'],
    data(){
        return{
            game: {},
            gamePos:0,
            query:''
        }
    },
    methods:{
        setGame(game,pos){
            this.game = game;
            this.gamePos = pos;
            editModal.show();
        },

        updateGame(game){
            this.game.rom = game.rom;
            this.game.thumbnail = game.thumbnail;
        },

        deleteEvent(){
            this.$emit('delete-event', this.gamePos);
        },

        searchEvent(){
            this.$emit('search-event', this.query);
        }
    },

    mounted() {
        editModal = initModal('editGameModal');
    }
}

</script>

<template>
    <div class="card mt-4">
        <div class="card-header">
            <form class="d-flex justify-content-between align-items-center" role="search">
                <h5 class="mb-0">Games List</h5>
                <input class="form-control me-2 w-25" type="search" placeholder="Search" aria-label="Search" @keyup="searchEvent" v-model="query">
            </form>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Game ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Description</th>
                    <th>Game Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Display game details in rows -->
                <tr v-for="(game, index) in games">
                    <td>{{game.id}}</td>
                    <td>{{game.title}}</td>
                    <td>{{game.genre}}</td>
                    <td>{{game.description}}</td>
                    <td><img :src="`/game/thumbnail/${game.thumbnail}`" alt="" width="50"></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm netflix-btn" @click="setGame(game, index)">Edit</button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    <edit-game :game="game" @post-event="updateGame" :genres="genres"></edit-game>
    <delete @delete-event="deleteEvent"></delete>
</template>

<style scoped>

</style>
