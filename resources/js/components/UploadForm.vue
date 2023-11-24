<script>
import * as utils from "../utils.js";
export default {
    name: "UploadForm",
    props:['game', 'formName', 'url', 'genres', 'submitName'],

    methods:{
        async postForm(url, formName) {
            const form = document.getElementById(formName);
            const formData = new FormData(form);
            const game = await utils.sendData(url, 'POST', true, formData);

            if(game)
                this.$emit('post-event', game);
        }
    }
}
</script>

<template>
    <form class="text-color" :id="formName">
        <input class="d-none" v-model="game.id" name="id">
        <div class="mb-3">
            <label for="gameTitle" class="form-label">Game Title</label>
            <input type="text" class="form-control" id="gameTitle" placeholder="Enter game title" v-model="game.title" name="title">
        </div>
        <div class="mb-3">
            <label for="gameDescription" class="form-label">Game Description</label>
            <textarea class="form-control" id="gameDescription" rows="3" placeholder="Enter game description" v-model="game.description" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="genreDropdown" class="form-label">Genre</label>
            <select class="form-select" id="genreDropdown" name="genre">
                <option v-for="genre in genres" :key="genre" :value="genre">{{ genre }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="gameFile" class="form-label">Game ROM File</label>
            <input type="file" class="form-control" id="gameFile" name="rom">
            <span class="text-primary">{{game.rom}}</span>
        </div>
        <div class="mb-3">
            <label for="gameImage" class="form-label">Game Image</label>
            <input type="file" class="form-control" id="gameImage" name="thumbnail">
            <span class="text-primary">{{game.thumbnail}}</span>
        </div>
        <button type="button" class="btn btn-primary netflix-btn" @click="postForm(url,formName)">{{submitName}}</button>
    </form>

</template>

<style>
.text-color{
    color: black;
}
</style>
