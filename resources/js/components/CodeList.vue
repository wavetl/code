<style>

</style>

<template>
    <div>
        <div class="spinner-container" v-if="loading">
            <spinner :loading="true" :color="'#3490dc'"></spinner>
        </div>
        <div v-else>
            <div class="card mb-3" v-for="code in resource.data">
                <div class="card-header">
                    <a :href="'/code/' + code.slug + '/' + code.id"><i class="fa fa-code mr-1"></i> {{ code.subject
                        }}</a>
                    <div class="float-right" v-if="is_author">
                        <a class="btn btn-outline-success btn-sm text-success" :href="'/edit/' + code.id"><i
                                class="fa fa-edit"></i> </a>
                        <button class="btn btn-outline-danger btn-sm" @click="deleteCode(code.id)"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="card-body code-body">
                    <codemirror :value="code.code" :options="getOptions(code.language)"></codemirror>
                </div>
                <div class="card-footer">
                        <span class="mr-2" :class="code_language_mapping[code.language].cssClass"><i
                                :class="'fab fa-' + code.language"></i> {{ code_language_mapping[code.language].name }}</span>
                    <span class="text-secondary"><i class="fa fa-user-alt"></i> <a class="text-secondary"
                                                                                   :href="'/user/info/' + code.user.id">{{ code.user.name }}</a> 分享于 {{ code.created_at }}</span>
                    <button class="btn btn-secondary-outline btn-sm float-right ml-1"><i class="far fa-thumbs-up"></i> 0
                    </button>
                </div>
            </div>

            <nav aria-label="Page navigation example" v-if="!code_id &&  resource.total > 0">
                <ul class="pagination justify-content-center">
                    <li class="page-item " :class="{'disabled' : resource.current_page === 1}">
                        <a class="page-link" :href="pathname + '?page=' + (resource.current_page - 1)"
                           tabindex="-1">上一页</a>
                    </li>
                    <li class="page-item" :class="{'disabled' : resource.current_page === page}"
                        v-for="page in resource.last_page"><a class="page-link" :href="pathname + '?page=' + page">{{
                        page }}</a></li>
                    <li class="page-item" :class="{'disabled' : resource.current_page >= resource.last_page}">
                        <a class="page-link" :href="pathname + '?page=' + (resource.current_page + 1)">下一页</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    // require component
    import {codemirror} from 'vue-codemirror'

    // require styles
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/theme/solarized.css'
    import 'codemirror/theme/cobalt.css'
    import 'codemirror/theme/material.css'
    import 'codemirror/mode/javascript/javascript.js'
    import 'codemirror/mode/php/php.js'
    import 'codemirror/mode/python/python.js'
    import 'codemirror/mode/css/css.js'

    import FadeLoader from 'vue-spinner/src/FadeLoader'

    const Swal = require('sweetalert2')

    export default {
        name: 'code_list',
        components: {
            codemirror,
            'spinner': FadeLoader
        },
        props: ['code_id', 'language', 'user_id', 'is_author', 'page'],
        data() {
            return {
                resource: {'data': []},
                pathname: '',
                code_language_mapping: {
                    'php': {
                        'id': 'php',
                        'name': 'PHP',
                        'mime': 'application/x-httpd-php',
                        'theme': 'cobalt',
                        'cssClass': 'text-primary'
                    },
                    'js': {
                        'id': 'js',
                        'name': 'JavaScript',
                        'mime': 'text/javascript',
                        'theme': 'solarized light',
                        'cssClass': 'text-success'
                    },
                    'python': {
                        'id': 'python',
                        'name': 'Python',
                        'mime': 'text/x-python',
                        'theme': 'material',
                        'cssClass': 'text-danger'
                    },
                    'css': {
                        'id': 'css',
                        'name': 'CSS',
                        'mime': 'text/css',
                        'theme': 'material',
                        'cssClass': 'text-info'
                    }
                },
                loading: false,
            }
        },
        created() {
            this.pathname = window.location.pathname
            if (typeof (this.code_id) === 'number') {
                this.fetchCode()

            } else {
                this.fetchCodeList()
            }
        },
        mounted() {
          console.log(this.$el.innerHTML)
        },
        methods: {
            fetchCode() {
                this.loading = true
                let data = {'code_id': this.code_id}
                this.$axios.post('code/find', data).then((res) => {
                    this.resource.data = [res.data]
                    this.$nextTick(() => {
                        this.loading = false
                    })
                })
            },
            fetchCodeList() {
                this.loading = true
                let data = {'language': this.language, 'user_id': this.user_id, 'page': this.page}
                this.$axios.post('code/list', data).then((res) => {
                    this.resource = res.data
                    this.$nextTick(() => {
                        this.loading = false
                    })
                })
            },
            getOptions(language) {
                return {
                    tabSize: 4,
                    mode: this.code_language_mapping[language].mime,
                    theme: this.code_language_mapping[language].theme,
                    lineNumbers: true,
                    line: true,
                    showCursorWhenSelecting: true,
                    readOnly: true
                }
            },
        }
    }
</script>