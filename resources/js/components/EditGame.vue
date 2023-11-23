<script>
import UploadForm from "@/components/UploadForm.vue";
import {initModal} from "../utils.js";

let deleteModal;
export default {
    name: "EditGame",
    components: {UploadForm},
    props:['game', 'genres'],
    methods:{
        postEvent(game){
            this.$emit('post-event', game);
        },

        showDeleteModal(){
            deleteModal.show();
        }
    },
    mounted() {
        deleteModal = initModal('deleteModal');
    }
}
</script>

<template>
    <div class="modal fade" id="editGameModal" tabindex="-1" aria-labelledby="editGameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-color" id="editGameModalLabel">Edit Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <upload-form :game="game" :genres="genres" formName="editForm" url="/admin/game/update" @post-event="postEvent"></upload-form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="showDeleteModal">Delete</button>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
