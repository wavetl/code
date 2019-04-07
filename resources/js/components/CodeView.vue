<style>

</style>

<template>
    <div>
        <template slot="code" class="d-none"></template>
        <div class="spinner-container" v-if="loading">
            <spinner :loading="true" :color="'#3490dc'"></spinner>
        </div>
        <codemirror v-else :value="code" :options="cmOptions"></codemirror>
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

    export default {
        name: 'code_view',
        components: {
            codemirror,
            'spinner': FadeLoader
        },
        props: ['language'],
        data() {
            return {
                loading: true,
                code: '',
                subject: '',
                code_language: {},
                code_language_list: [
                    {
                        'id': 'php',
                        'name': 'PHP',
                        'mime': 'application/x-httpd-php',
                        'theme': 'cobalt',
                        'cssClass': 'btn-outline-primary'
                    },
                    {
                        'id': 'js',
                        'name': 'JavaScript',
                        'mime': 'text/javascript',
                        'theme': 'solarized light',
                        'cssClass': 'btn-outline-success'
                    },
                    {
                        'id': 'python',
                        'name': 'Python',
                        'mime': 'text/x-python',
                        'theme': 'material',
                        'cssClass': 'btn-outline-danger'
                    },
                    {
                        'id': 'css',
                        'name': 'CSS',
                        'mime': 'text/css',
                        'theme': 'material',
                        'cssClass': 'btn-outline-info'
                    }
                ],
                cmOptions: {
                    tabSize: 4,
                    lineNumbers: true,
                    line: true,
                    showCursorWhenSelecting: true,
                    theme: '',
                    mime: '',
                    readOnly: true
                }
            }
        },
        methods: {
            changeCodeLanguage(lang) {
                this.code_language_list.filter((v, i) => {
                    if (lang === v.id) {
                        this.code_language = v;
                        return;
                    }
                });
            }
        },
        watch: {
            code_language(val, oldVal) {
                this.cmOptions.mode = val.mime;
                this.cmOptions.theme = val.theme;
            }
        },
        mounted() {
            this.loading = true
            this.code = this.$slots.default[0].text
            this.changeCodeLanguage(this.language)
            this.$nextTick(() => {
                window.setTimeout(() => {
                    this.loading = false
                }, 150);
            })
        },
        created() {
        }
    }
</script>