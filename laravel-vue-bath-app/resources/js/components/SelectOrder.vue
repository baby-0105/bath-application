<template>
    <div class="select-order" id="selectOrderBlock">
        <p class="status-error error"></p><p class="timeout-error error"></p><p class="select-order-error error"></p>
        <form method="POST" action="">
            <select name="selectOrder" class="select" id="selectOrder" @change="onChange">
                <option value="new" selected>最新の投稿順</option>
                <option value="eval">総合評価 順</option>
                <option value="hot_water_eval">お湯評価 順</option>
                <option value="rock_eval">岩盤浴評価 順</option>
                <option value="sauna_eval">サウナ評価 順</option>
            </select>
        </form>
        <ul class="bath">
            <li class="list" v-for="post in posts" :key="post.id">
                <a class="dlt-post" :value="post.id" @click="dltPost(post.id)"><img class="dlt-post-img" :src="'../svg/dlt-icon.svg'" alt="投稿削除ボタン"></a>
                <h4 class="title">- {{ post.title }} -</h4>
                <div class="desc">
                    <div class="info">
                        <div class="bath-img">
                            <img class="main-img" :src="'../storage/' + post.main_image_path + '?' + post.updated_at.replace(/[^0-9]/g, '')" alt="風呂の画像 メイン" v-if="post.main_image_path"><img class="main-img" :src="'../svg/bath-mark-light-blue.svg'" alt="風呂の画像 メイン" v-else>
                            <div class="sub-imgs" v-if="post.sub_picture1_path || post.sub_picture2_path || post.sub_picture3_path">
                                <img
                                    v-if="post.sub_picture1_path"
                                    class="sub-img sub-img1"
                                    :src="'../storage/' + post.sub_picture1_path + '?' + post.updated_at.replace(/[^0-9]/g, '')"
                                    alt="風呂のサブ画像"
                                    @mouseover="changeToMainImg"
                                    @mouseleave="changeToSubImg"
                                >
                                <img
                                    v-if="post.sub_picture2_path"
                                    class="sub-img sub-img2"
                                    :src="'../storage/' + post.sub_picture2_path + '?' + post.updated_at.replace(/[^0-9]/g, '')"
                                    alt="風呂のサブ画像"
                                    @mouseover="changeToMainImg"
                                    @mouseleave="changeToSubImg"
                                >
                                <img
                                    v-if="post.sub_picture3_path"
                                    class="sub-img sub-img3"
                                    :src="'../storage/' + post.sub_picture3_path + '?' + post.updated_at.replace(/[^0-9]/g, '')"
                                    alt="風呂のサブ画像"
                                    @mouseover="changeToMainImg"
                                    @mouseleave="changeToSubImg"
                                >
                            </div>
                        </div>
                        <ul class="review-num tablet-block">
                            <li>{{ post.eval_cd }}</li>
                            <li v-if="post.hot_water_eval_cd"> {{ post.hot_water_eval_cd }}</li><li v-else>--</li>
                            <li v-if="post.rock_eval_cd"> {{ post.rock_eval_cd }} </li><li v-else>--</li>
                            <li v-if="post.sauna_eval_cd"> {{ post.sauna_eval_cd }}</li><li v-else>--</li>
                        </ul>
                    </div>
                    <div class="review">
                        <p class="thoughts" v-if="post.thoughts"> {{ post.thoughts }} </p>
                        <ul class="review-num pc-block">
                            <li>{{ post.eval_cd }}</li>
                            <li v-if="post.hot_water_eval_cd"> {{ post.hot_water_eval_cd }}</li><li v-else>--</li>
                            <li v-if="post.rock_eval_cd"> {{ post.rock_eval_cd }} </li><li v-else>--</li>
                            <li v-if="post.sauna_eval_cd"> {{ post.sauna_eval_cd }}</li><li v-else>--</li>
                        </ul>
                    </div>
                </div>
                <p class="post-time">{{ post.updated_at.replace(/-/g, '/') }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: {},
                mainImgSrc: '',
            }
        },
        methods: {
            onChange: function(e) {
                axios.defaults.baseURL = process.env.VUE_APP_API_ENDPOINT
                const url = '/post/mypost/selectOrder';
                $('#myPost .error').text('');
                axios.post(url, {
                    selectOrder: e.target.value,
                })
                .then(response => {
                    this.posts = response.data;
                    $('#myPost .bath.first-view').addClass('hide');
                })
                .catch(e => {
                    $('#myPost .select-order-error').text(e.response.data.errors.selectOrder);
                })
            },
            dltPost: function(postId) {
                $('#myPost .popup-delete').removeClass('hide');
                $('#myPost .popup-delete').addClass('flex');
                $('#myPost .popup-delete #postId').attr('value', postId);
            },
            changeToMainImg(e) {
                console.log(e);
                let src      = e.target.getAttribute("src"),
                    $mainImg = $('#selectOrderBlock .sub-img').parents('.sub-imgs').prev('.main-img');
                this.mainImgSrc = $mainImg.attr('src');
                $mainImg.attr('src', src);
            },
            changeToSubImg() {
                let $mainImg = $('#selectOrderBlock .sub-img').parents('.sub-imgs').prev('.main-img');
                $mainImg.attr('src', this.mainImgSrc);
            }
        },
    }
</script>

<style lang="scss">
    .select-order .select {
        margin-bottom: 20px;
        width: 30%;
        padding: 10px;
        display: block;
        margin-left: auto;
        font-size: 1.6rem;
        @media screen and (max-width: 1024px) {
            width: 50%;
        }
        @media screen and (max-width: 599px) {
            width: 100%;
        }
    }
</style>