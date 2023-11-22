<script>
import GameCard from "@/components/GameCard.vue";

export default {
    name: "Category",
    components: {GameCard},
    props:['catValue', 'catKey','recentlyPlayed', 'isFavorite'],
    methods:{
        generateId(key) {
            return removeSpaces(key);
        },

        toggleHeart(game) {
            this.$emit('toggle-heart-event', game);
        },

        removeRecentlyPlayed(game) {
            this.$emit('remove-recently-played-event', game);
        },

        addToRecentlyPlayed(game) {
            this.$emit('add-to-recently-played-event', game);
        }
    }
}

function removeSpaces(word){
    return word.replace(/\s/g, '');
}
</script>

<template>
    <div v-if="catValue.length!==0">
        <h2 class="game-title">{{catKey}}</h2>
        <div :id="generateId(catKey)" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div v-for="(gameChunk, index) in catValue" :key="index" class="carousel-item" :class="{ 'active': index === 0 }">
                    <div class="row">
                        <div v-for="(game, index) in gameChunk" :key="index" class="col-md-4">
                            <game-card :game="game" :recentlyPlayed="recentlyPlayed" :isFavorite="isFavorite" @toggle-heart-event="toggleHeart" @remove-recently-played-event="removeRecentlyPlayed" @add-to-recently-played-event="addToRecentlyPlayed"></game-card>
                        </div>

                    </div>
                </div>
            </div>
            <div v-if="catValue.length >1">
                <a class="carousel-control-prev" :href="`#${generateId(catKey)}`" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" :href="`#${generateId(catKey)}`" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.game-title{
    padding-left: 15px;
}

.carousel-control-prev {
    left: -60px;
}

.carousel-control-next {
    right: -60px;
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23e50914' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
}

.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23e50914' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
}
</style>
