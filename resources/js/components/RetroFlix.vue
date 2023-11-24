<script>
import BannerComponent from "@/components/BannerComponent.vue";

import * as utils from "../utils.js";

const favKey = 'Favorites';
const recentKey = 'Continue Playing...';
let becauseYouWatched = 'Because You Played '
export default {
    name: "RetroFlix",
    components: {BannerComponent},

    data() {
        return {
            categories: [],
            favoritesTracker: {},
            recentlyPlayedTracker: {},
            pageLoaded: false
        };
    },

    methods: {
        toggleHeart(game) {
            const clickedElement = game.event.target;

            if(clickedElement.classList.contains('red-heart'))
                this.removeFavorite(game.game);

            else this.addToFavorites(game.game);
        },

        async addToFavorites(game){
            await this.addToCategory(game, this.favoritesTracker, favKey, this.categories, `/game/addFavorite/${game.id}`);
        },

        async addToRecentlyPlayed(game){
            await this.addToCategory(game, this.recentlyPlayedTracker, recentKey, this.categories, `/game/addRecentlyPlayed/${game.id}`);
        },

        async addToCategory(game, tracker, categoryName, categories, endpoint) {

            if(!tracker.has(game.id)) {

                const response = await utils.sendData(endpoint, 'PUT', false);

                if(response) {
                    const gameChunks = categories.get(categoryName);
                    const lastChunk = gameChunks[gameChunks.length - 1];

                    if (lastChunk && lastChunk.length < 3)
                        lastChunk.push(game);
                    else
                        gameChunks.push([game]);

                    buildCatMap(tracker, gameChunks, gameChunks.length - 1);
                }
            }
        },

        async removeFavorite(game){
            await this.removeFromCategory(game, this.favoritesTracker, this.categories, favKey,`/game/removeFavorite/${game.id}`);
        },

        async removeRecentlyPlayed(game){
            await this.removeFromCategory(game, this.recentlyPlayedTracker, this.categories, recentKey, `/game/removeRecentlyPlayed/${game.id}`);
        },

        async removeFromCategory(game, tracker, categories, categoryName, endpoint){
            const response = await utils.sendData(endpoint, 'DELETE', false);

            if(response) {
                const location = tracker.get(game.id);
                const favChunks = categories.get(categoryName);
                const favChunk = favChunks[location[0]];

                if (favChunk.length <= 1) {
                    prevCarousel(categoryName);
                    favChunks.pop();
                } else {
                    favChunk.splice(location[1], 1);
                }

                tracker.delete(game.id);
            }
        },

        async fetchData(){
            return await Promise.all([
                utils.fetchJSON('/game/all'),
                utils.fetchJSON('/game/favorites'),
                utils.fetchJSON('/game/recentlyPlayed')
            ]);
        },

        isFavorite(gameId) {
            return this.favoritesTracker.has(gameId);
        },

        recentlyPlayed(gameId) {
            return this.recentlyPlayedTracker.has(gameId);
        },

        initializeTracker(gameMap, games, key, chunkSize){
            gameMap.set(key, chunkArray(games,chunkSize));
            const tracker = new Map();

            buildCatMap(tracker, gameMap.get(key));

            return tracker;
        },
        generateId(key) {
            return removeSpaces(key);
        }
    },

    async mounted() {
        const [gameObjects, favorites, recentlyPlayed] = await this.fetchData();
        becauseYouWatched+=getTitleOfLastPlayedGame(recentlyPlayed);

        const chunkSize = 3;

        const gameMap = new Map([
            [recentKey, []],
            [becauseYouWatched, []],
            [favKey, []]]);

        this.categories = chunkGames(gameObjects, chunkSize, gameMap);

        this.favoritesTracker = this.initializeTracker(gameMap, favorites, favKey, chunkSize);
        this.recentlyPlayedTracker = this.initializeTracker(gameMap, recentlyPlayed, recentKey, chunkSize);
        generateRecommendations(recentlyPlayed, this.categories);
    }
}

function getTitleOfLastPlayedGame(recentlyPlayedGames){
    if(recentlyPlayedGames.length !==0)
        return getLastElement(recentlyPlayedGames).title;
}

function generateRecommendations(recentlyPlayedGames, categories){
    if(recentlyPlayedGames.length !==0) {
        const lastGenre = getLastElement(recentlyPlayedGames).genre;
        categories.set(becauseYouWatched, categories.get(lastGenre));
    }
}

function getLastElement(array){
    return array[array.length-1];
}

function prevCarousel(id){
    const carousel = new bootstrap.Carousel(`#${removeSpaces(id)}`);
    carousel.prev();
}

function buildCatMap(map, favoriteGames){
    mapGameLocations(map, favoriteGames, 0);
}

function chunkGames(gameObjects, chunkSize, categoriesMap){
    const categorizedGames = categorizeGames(gameObjects, categoriesMap);

    categorizedGames.forEach((value, key) => {
        categorizedGames.set(key, chunkArray(value, chunkSize));
    });

    return categorizedGames;
}

function chunkArray(arr, chunkSize) {
    const result = [];

    for (let i = 0; i < arr.length; i += chunkSize) {
        result.push(arr.slice(i, i + chunkSize));
    }

    return result;
}

function categorizeGames(gameObjects, categoriesMap) {
    gameObjects.forEach(game => {
        categorizeGame(categoriesMap, game);
    });

    return categoriesMap;
}

function removeSpaces(word){
    return word.replace(/\s/g, '');
}

function categorizeGame(categoriesMap, game) {
    const genre = game.genre;

    if (!categoriesMap.has(genre))
        categoriesMap.set(genre, []);

    categoriesMap.get(genre).push(game);
}

function mapGameLocations(map, nestedArray, startPos){

    for(let i=startPos; i<nestedArray.length; i++){
        for(let j=0; j<nestedArray[i].length; j++){
            const location =[i,j];
            map.set(nestedArray[i][j].id, location);
        }
    }
}

</script>

<template >
    <div>
        <banner-component></banner-component>
        <div class="container mt-4 games-container">
            <div v-for="[key, value] in categories" :key="key" >
                <category-component :cat-key="key" :cat-value="value" :recentlyPlayed="recentlyPlayed" :isFavorite="isFavorite" @toggle-heart-event="toggleHeart" @remove-recently-played-event="removeRecentlyPlayed" @add-to-recently-played-event="addToRecentlyPlayed"></category-component>
            </div>
        </div>
    </div>
</template>

<style scoped>

    .games-container{
        margin-top: -100px !important;
        opacity: 0.8;
    }
</style>
