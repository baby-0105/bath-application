<template>
    <div class="select-order">
        <p class="error" v-for="error in errors" :key="error.id">{{ error[0] }}</p>
        <form>
            <select name="selectOrder" class="select" @change="onChange">
                <option v-for="selectOrder in selectOrders"
                        :key="selectOrder.id"
                        :value="selectOrder.value">
                {{ selectOrder.name }}</option>
            </select>
        </form>
        <ul class="bath">
            <li class="list" v-for="(post, index) in posts" :key="post.id" @mouseover="getIndex(index)" @mouseleave="dltIndex(index)">
                <a class="dlt-post" :value="post.id" @click="dltPost(post.id)"><img class="dlt-post-img" :src="'../svg/dlt-icon.svg'" alt="投稿削除ボタン"></a>
                <a :href="post.bath.url" target="_blank" rel="noopener noreferrer"><h4 class="title">{{ post.title }}</h4></a>
                <div class="desc">
                    <div class="info">
                        <div class="bath-img">
                            <div class="main-img-block">
                                <img
                                    class="main-img"
                                    alt="風呂メイン画像"
                                    :src="hoverdImg"
                                    v-if="post.main_image_path && index === hoverdIndex && hoverdImg">
                                <img
                                    class="main-img"
                                    alt="風呂メイン画像"
                                    :src="imgSrc(post.main_image_path, post.updated_at)"
                                    v-else-if="post.main_image_path">
                                <img class="main-img-only" alt="風呂メイン画像" :src="'../svg/bath-mark-light-blue.svg'" v-else>
                            </div>
                            <ul class="sub-imgs" v-if="post.sub_picture1_path || post.sub_picture2_path || post.sub_picture3_path">
                                <li class="sub-img-list">
                                    <img
                                        @mouseover="changeToMainImg"
                                        @mouseleave="backToSubImg"
                                        class="sub-img"
                                        alt="風呂のサブ画像"
                                        :src="imgSrc(post.sub_picture1_path, post.updated_at)"
                                        v-if="post.sub_picture1_path"
                                    >
                                    <img class="sub-img" alt="風呂の画像 サブ" :src="'../svg/bath-mark-light-blue.svg'" v-else>
                                </li>
                                <li class="sub-img-list">
                                    <img
                                        @mouseover="changeToMainImg"
                                        @mouseleave="backToSubImg"
                                        class="sub-img"
                                        alt="風呂のサブ画像"
                                        :src="imgSrc(post.sub_picture2_path, post.updated_at)"
                                        v-if="post.sub_picture2_path"
                                    >
                                    <img class="sub-img" alt="風呂の画像 サブ" :src="'../svg/bath-mark-light-blue.svg'" v-else>
                                </li>
                                <li class="sub-img-list">
                                    <img
                                        @mouseover="changeToMainImg"
                                        @mouseleave="backToSubImg"
                                        class="sub-img"
                                        alt="風呂のサブ画像"
                                        :src="imgSrc(post.sub_picture3_path, post.updated_at)"
                                        v-if="post.sub_picture3_path"
                                    >
                                    <img class="sub-img" alt="風呂の画像 サブ" :src="'../svg/bath-mark-light-blue.svg'" v-else>
                                </li>
                            </ul>
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
                <p class="post-time">{{ postTime(post.updated_at) }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                firstMainImg: '',
                selectOrders: {
                    new         : { id: 1, name: '最新の投稿順', value: 'new' },
                    eval        : { id: 2, name: '全体評価 順', value: 'eval' },
                    hotWaterEval: { id: 3, name: 'お湯評価 順', value: 'hot_water_eval' },
                    rockEval    : { id: 4, name: '岩盤浴評価 順', value: 'rock_eval' },
                    saunaEval   : { id: 5, name: 'サウナ評価 順', value: 'sauna_eval' },
                },
                errors: {},
                hoverdImg: '',
                hoverdIndex: '',
            }
        },
        props: {
            posts: { type: Array },
        },
        computed: {
            imgSrc() {
                return function(path, time) {
                    return '../storage/' + path+ '?' + time.replace(/[^0-9]/g, '');
                }
            },
            postTime() {
                return function(time) {
                    return time.replace(/-/g, '/');
                }
            }
        },
        methods: {
            onChange(e) {
                axios.defaults.baseURL = process.env.VUE_APP_API_ENDPOINT;
                const url = '/post/mypost/selectOrder';
                this.errors = '';
                axios.post(url, {
                    selectOrder: e.target.value,
                })
                .then(response => {
                    this.posts = response.data;
                    $('#myPost .bath.first-view').addClass('hide');
                })
                .catch(e => {
                    this.errors = e.response.data.errors;
                })
            },
            dltPost(postId) {
                $('#myPost .popup-delete').removeClass('hide');
                $('#myPost .popup-delete').addClass('flex');
                $('#myPost .popup-delete #postId').attr('value', postId);
            },
            getIndex(index) { this.hoverdIndex = index; },
            dltIndex() { this.hoverdIndex = ''; },
            changeToMainImg(e) { this.hoverdImg = e.target.getAttribute('src'); },
            backToSubImg() { this.hoverdImg = ''; }
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

    .select-order .bath .main-img-only {
        max-height: 200px;
    }
</style>