<script>

export default {
    name: "GameCard",
    props: ['game','recentlyPlayed', 'isFavorite'],

    methods: {
        toggleHeart(event, game) {
            this.$emit('toggle-heart-event', {game: game,
            event: event});
        },

        removeRecentlyPlayed(game) {
            this.$emit('remove-recently-played-event', game);
        },

        addToRecentlyPlayed(game) {
            this.$emit('add-to-recently-played-event', game);
            window.open(`/game/playGame/${game.rom}`, '_blank');
        }
    }
}

</script>

<template>
    <div class="card netflix-card">
        <img :src="`/game/thumbnail/${game.thumbnail}`" class="card-img-top" alt="Game 1">
        <div class="card-body">
            <h5 class="card-title">{{game.title}}</h5>
            <p class="card-text">{{game.description}}</p>
            <div class="text-justify">
                <a href="#" class="btn btn-primary netflix-btn" @click="addToRecentlyPlayed(game)"><i class="bi bi-play-circle-fill"></i> Play Now</a>
                <i class="bi bi-heart-fill" :class="{ 'red-heart': isFavorite(game.id) }" @click="toggleHeart($event, game)"></i>
                <i v-if="recentlyPlayed(game.id)" @click="removeRecentlyPlayed(game)" class="bi bi-eye-slash-fill"></i>
            </div>
        </div>
    </div>
</template>

<style scoped>

.netflix-card {
    background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));
    color: white;
    border: none;
    border-radius: 10px;
    padding: 15px;
    transition: transform 0.2s;
}

.netflix-card:hover {
    transform: scale(1.05);
}

.netflix-card .card-title {
    font-size: 24px;
}

.netflix-card .card-text {
    font-size: 16px;
}

.text-justify {
    display: flex;
    justify-content: space-between;
}

.red-heart{
    color: #b70510;
}

.bi-heart-fill:active{
    color: black;
}
</style>
