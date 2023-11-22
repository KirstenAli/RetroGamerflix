import { createApp } from 'vue';

const app = createApp({});

import BannerComponent from "./components/BannerComponent.vue";
import Category from "./components/Category.vue";
import GameCard from "./components/GameCard.vue";
import RetroFlix from "./components/RetroFlix.vue";

import UploadForm from "./components/UploadForm.vue";
import Message from "./components/Message.vue";
import GameTable from "./components/GameTable.vue";
import AdminPanel from "./components/AdminPanel.vue";

app.component('retro-flix', RetroFlix);
app.component('banner-component', BannerComponent);
app.component('category-component', Category);
app.component('game-component', GameCard);

app.component('upload-form', UploadForm);
app.component('message', Message);
app.component('game-table', GameTable);
app.component('admin-panel', AdminPanel);

app.mount('#app');
