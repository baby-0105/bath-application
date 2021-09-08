<template>
    <div class="bath-index">
        <ul class="bath">
            <p class="bath-num" v-if="favorited.length > 0">お気に入り件数：{{ favorited.length }}件</p>
            <li class="list" v-for="favorite in favorited" :key="favorite.id">
                <p v-if="favorite.bath[0].id == responseId" class="favorite-error error"></p>
                <div class="title-block">
                    <h4 class="title">{{ favorite.bath[0].name }}</h4>
                    <a v-if="unFavoritedId.includes(favorite.bath[0].id)" @click="addFavorite(favorite.bath[0].id)"><img class="star-icon" :src="'../svg/star-gray.svg'" alt="お気に入り 星アイコン 灰色"></a>
                    <a v-else @click="unFavorite(favorite.bath[0].id)"><img class="star-icon" :src="'../svg/star-yellow.svg'" alt="お気に入り 星アイコン 黄色"></a>
                </div>
                <div class="mark-block">
                    <div class="review">
                        <p class="whole-review" v-if="favorite.bath[0].eval_cd !== null">{{ favorite.bath[0].eval_cd }}</p><p class="whole-review" v-else>--</p>
                        <ul class="others-review">
                            <li v-if="favorite.bath[0].hot_water_eval_cd !== null">{{ favorite.bath[0].hot_water_eval_cd }}</li><li v-else>--</li>
                            <li v-if="favorite.bath[0].rock_eval_cd !== null">{{ favorite.bath[0].rock_eval_cd }}</li><li v-else>--</li>
                            <li v-if="favorite.bath[0].sauna_eval_cd !== null">{{ favorite.bath[0].sauna_eval_cd }}</li><li v-else>--</li>
                        </ul>
                    </div>
                    <ul class="mark" v-if="favorite.bath[0].is_rock !== null && favorite.bath[0].is_sauna !== null">
                        <li class="rock" v-if="favorite.bath[0].is_rock !== null">岩盤浴有</li>
                        <li class="sauna" v-if="favorite.bath[0].is_sauna !== null">サウナ有</li>
                    </ul>
                </div>
                <div class="text-info">
                    <p class="place">{{ favorite.bath[0].place }} {{ favorite.bath[0].city }}</p>
                    <p class="closing-day">{{ favorite.bath[0].closing_day }}</p>
                    <!-- <ul class="time">
                        <li class="holiday" v-if="favorite.bath[0].holiday_time !== null">土日：{{ favorite.bath[0].holiday_time }}</li><li v-else>土日：記載なし</li>
                        <li class="weekday" v-if="favorite.bath[0].weekday_time !== null">平日：{{ favorite.bath[0].weekday_time }}</li><li v-else>平日：記載なし</li>
                    </ul> -->
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                unFavoritedId: [],
                responseId: '',
            }
        },
        props: {
            favorited: { type: Array },
        },
        methods: {
            addFavorite(bathId) {
                const url = '/bath/addFavorite';
                $('.favorite .error').text('');
                axios.post(url, {
                    bathId: bathId,
                })
                .then(response => {
                    let val = response.data,
                        index = this.unFavoritedId.indexOf(val);

                    this.unFavoritedId.splice(index, 1);
                })
                .catch(e => {
                    $('.favorite .favorite-error').text(e.response.data.errors.bathId);
                })
            },
            unFavorite(bathId) {
                const url = '/bath/unFavorite';
                $('.favorite .error').text('');
                axios.post(url, {
                    bathId: bathId,
                })
                .then(response => {
                    this.responseId = response.data;
                    this.unFavoritedId.push(response.data);
                })
                .catch(e => {
                    $('.favorite .favorite-error').text(e.response.data.errors.bathId);
                })
            }
        }
    }
</script>
