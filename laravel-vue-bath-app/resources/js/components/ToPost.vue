<template>
    <div class="bath-search list">
        <label class="field-name">お風呂検索<span class="red">*</span></label>
        <div class="search-block">
            <p class="prefecture-error error"></p>
            <p class="keyword-error error"></p>
            <p class="field-error error"></p>
            <div class="search-field">
                <select class="select" v-model="selectedPrefecture">
                    <option value="">都道府県を選択してください</option>
                    <option v-for="prefecture in prefectures" :key="prefecture.code" :value="prefecture.code">{{ prefecture.name }}</option>
                </select>
                <input class="keyword" v-model="keyword" placeholder="キーワードを入力してください" type="text">
                <a class="search-btn" @click="searchBath()">検索</a>
            </div>
            <div class="search-result" v-if="baths.length > 0">
                <select class="select" v-model="selectedBath" name="bath_code">
                    <option v-for="bath in baths" :key="bath.id" :value="bath.id">{{ bath.name }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedPrefecture: '',
                keyword: '',
                selectedBath: '',
                baths: {},
            }
        },
        props: {
            prefectures: { type: Array },
        },
        methods: {
            searchBath() {
                const url = '/post/search/';
                $('.bath-search .error').text('');
                axios.post(url, {
                    prefecture: this.selectedPrefecture,
                    keyword: this.keyword,
                })
                .then(response => {
                    this.baths = response.data;
                })
                .catch(e => {
                    $('.bath-search .prefecture-error').text(e.response.data.errors.prefecture);
                    $('.bath-search .keyword-error').text(e.response.data.errors.keyword);
                    $('.bath-search .field-error').text(e.response.data.errors.field);
                })
            },
        }
    }
</script>

<style lang="scss">
    .post-form .search-block {
        width: 70%;
    }

    .post-form .search-field {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .post-form .search-field .select {
        width: 45%;
        padding: 10px;
    }

    .post-form .search-field .keyword {
        width: 40%;
        padding: 10px;
    }

    .post-form .search-field .search-btn {
        border: 1px solid #222;
        padding: 10px;
        border-radius: 5px;
        &:hover {
            cursor: pointer;
            color: #ffffff;
            background: #222;
        }
    }

    .post-form .search-result .select {
        width: 100%;
        padding: 10px;
    }
</style>
