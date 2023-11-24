<script>
export default {
    name: "BannerComponent"
}
</script>

<template>
    <div class="jumbotron position-relative">
        <img src="/mainBanner" alt="Game Cover Image" class="banner-img">
        <a href="/game/playGame/Pokemon Red (UE) [S][!].gb" target="_blank" class="btn btn-primary netflix-btn"><i class="bi bi-play-circle-fill"></i> Play Now</a>
    </div>
</template>

<style scoped>
    .banner-img{
        width: 100%;
        opacity: 0.4;
        mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0));
        -webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));
    }

    .jumbotron .netflix-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 15px 25px;
        font-size: 24px;
        transition: background-color 0.3s ease;
        opacity: 0.8;
    }
</style>
