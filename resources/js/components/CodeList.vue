<style>

</style>

<template>
    <div>
        <div class="spinner-container" v-if="loading">
            <spinner :loading="true" :color="'#3490dc'"></spinner>
        </div>
        <div v-else>
            <div class="card mb-3" v-for="code in code_list">
                <div class="card-header">
                    <a :href="'/code/' + code.slug + '/' + code.id"><i class="fa fa-code mr-1"></i> {{ code.subject
                        }}</a>
                    <div class="float-right" v-if="is_author">
                        <a class="btn btn-outline-success btn-sm text-success" :href="'/edit/' + code.id"><i class="fa fa-edit"></i> </a>
                        <button class="btn btn-outline-danger btn-sm" @click="deleteCode(code.id)"><i class="fa fa-trash"></i> </button>
                    </div>
                    <span class="float-right" v-else><i class="fa fa-user"></i>  <a
                            :href="'/user/info/' + code.user.id">{{ code.user.name }}</a></span>
                </div>
                <div class="card-body code-body">
                    <codemirror :value="code.code" :options="getOptions(code.language)"></codemirror>
                </div>
                <div class="card-footer">
                        <span class="mr-2" :class="cssClassMapping[code.language]"><i
                                :class="'fab fa-' + code.language"></i> {{ code_language_mapping[code.language].name }}</span>
                    <span class="text-secondary float-right"><i
                            class="fa fa-clock"></i> {{ code.created_at }}</span>
                </div>
            </div>
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

    import FadeLoader from 'vue-spinner/src/FadeLoader'

    const Swal = require('sweetalert2')

    export default {
        name: 'code_list',
        components: {
            codemirror,
            'spinner': FadeLoader
        },
        props: ['code_id', 'language', 'user_id', 'is_author'],
        data() {
            return {
                code_list: [],
                code_language_mapping: {
                    'php': {'id': 'php', 'name': 'PHP', 'mime': 'application/x-httpd-php', 'theme': 'cobalt'},
                    'js': {'id': 'js', 'name': 'JavaScript', 'mime': 'text/javascript', 'theme': 'solarized light'},
                    'python': {'id': 'python', 'name': 'Python', 'mime': 'text/x-python', 'theme': 'material'}
                },
                cssClassMapping: {
                    'php': {'text-primary': true},
                    'js': {'text-success': true},
                    'python': {'text-danger': true},
                },
                loading: false
            }
        },
        created() {
            if (typeof (this.code_id) === 'number') {
                this.fetchCode()

            } else {
                this.fetchCodeList()
            }
        },
        methods: {
            deleteCode(code_id) {
                Swal.fire({
                    text: '确定要删除这段代码吗？',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '确认',
                    cancelButtonText: '取消'
                }).then((res) => {
                    let data = {'id': code_id}
                    this.$axios.post('code/delete', data).then((res) => {
                        window.location.href = '/'
                    })
                });
            },
            fetchCode() {
                this.loading = true
                let data = {'code_id': this.code_id}
                this.$axios.post('code/find', data).then((res) => {
                    this.code_list = [res.data]
                    this.$nextTick(() => {
                        this.loading = false
                    })
                })
            },
            fetchCodeList() {
                this.loading = true
                let data = {'language': this.language, 'user_id': this.user_id}
                this.$axios.post('code/list', data).then((res) => {
                    this.code_list = res.data.data
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
            }
        }
    }
</script>