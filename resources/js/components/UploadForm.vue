<script>

export default {
    name: "UploadForm",
    props:['game']
}
</script>

<template>
    <form class="text-color">
        <div class="mb-3">
            <label for="gameTitle" class="form-label">Game Title</label>
            <input type="text" class="form-control" id="gameTitle" placeholder="Enter game title" v-model="game.title">
        </div>
        <div class="mb-3">
            <label for="gameDescription" class="form-label">Game Description</label>
            <textarea class="form-control" id="gameDescription" rows="3" placeholder="Enter game description" v-model="game.description"></textarea>
        </div>
        <div class="mb-3">
            <label for="genreDropdown" class="form-label">Genre</label>
            <select class="form-select" id="genreDropdown">
                <!-- Options for existing genres -->
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <!-- Add ability to add new genre -->
            </select>
        </div>
        <div class="mb-3">
            <label for="gameFile" class="form-label">Game ROM File</label>
            <input type="file" class="form-control" id="gameFile">
            <span class="text-primary">{{game.rom}}</span>
        </div>
        <div class="mb-3">
            <label for="gameImage" class="form-label">Game Image</label>
            <input type="file" class="form-control" id="gameImage">
            <span class="text-primary">{{game.thumbnail}}</span>
        </div>
        <button type="submit" class="btn btn-primary netflix-btn">Add Game</button>
    </form>

</template>

<style>
.text-color{
    color: black;
}
</style>
